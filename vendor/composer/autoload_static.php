<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit985e7cdcd6e7428db5fb20d421916bec
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Core\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit985e7cdcd6e7428db5fb20d421916bec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit985e7cdcd6e7428db5fb20d421916bec::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit985e7cdcd6e7428db5fb20d421916bec::$classMap;

        }, null, ClassLoader::class);
    }
}
