<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0b552b9df01b46c295ab48509c3e1918
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Simplexi\\Greetr\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Simplexi\\Greetr\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit0b552b9df01b46c295ab48509c3e1918::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0b552b9df01b46c295ab48509c3e1918::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0b552b9df01b46c295ab48509c3e1918::$classMap;

        }, null, ClassLoader::class);
    }
}
