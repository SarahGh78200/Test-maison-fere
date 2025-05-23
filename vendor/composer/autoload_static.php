<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit601bd76d402b7c62a8e0baa3ce40820a
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit601bd76d402b7c62a8e0baa3ce40820a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit601bd76d402b7c62a8e0baa3ce40820a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit601bd76d402b7c62a8e0baa3ce40820a::$classMap;

        }, null, ClassLoader::class);
    }
}
