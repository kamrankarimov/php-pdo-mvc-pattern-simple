<?php

namespace App\Core\Routes;

use App\Core\Config\UriParamsPatterns;
use App\Core\Exceptions\HttpRequestMethods;

class Route
{

    /**
     * @return string
     */
    private static function parse_url(): string
    {
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;

        $basename = basename($_SERVER['SCRIPT_NAME']);
        $request_uri = str_replace([$dirname, $basename], '', $_SERVER['REQUEST_URI']);

        return $request_uri;
    }

    /**
     * @param $url
     * @param $callback
     * @param $method
     * @return void
     */
    public static function run($url, $callback, $method = 'get'): void
    {
        $method = explode('|', strtoupper($method));

        if (in_array($_SERVER['REQUEST_METHOD'], $method)) {

            $patterns = new UriParamsPatterns();
            $patterns = $patterns->allPattern();


            $url = str_replace(array_keys($patterns), array_values($patterns), $url);
            $request_uri = self::parse_url();

            if (preg_match('@^' . $url . '$@', $request_uri, $parameters)) {
                unset($parameters[0]);

                if (is_callable($callback)) {
                    call_user_func_array($callback, $parameters);
                } else {
                    $controller = explode('@', $callback);
                    $className  = explode('/', $controller[0]);
                    $className  = ucfirst(end($className));
                    $className  = $className.'Controller';
                    $controllerFile =  dirname(__DIR__, 2) . '/Controllers/' . ucfirst(strtolower($controller[0])) . 'Controller.php';

                    if (file_exists($controllerFile)) {
                        require $controllerFile;

                        $className = "\\App\\Controllers\\".$className;
                        $methodName = $controller[1]."Action";
                        call_user_func_array([new $className, $methodName], $parameters);
                        exit;
                    }
                }

            }

        }else{
            HttpRequestMethods::MethodNotAllowed("POST", "405 Method Not Allowed");
        }

    }

}
