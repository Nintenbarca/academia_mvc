<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdfef9ef856eed45fc727573d7a1326c1
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/application/core',
        1 => __DIR__ . '/../..' . '/application/model',
        2 => __DIR__ . '/../..' . '/application/libs',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdfef9ef856eed45fc727573d7a1326c1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdfef9ef856eed45fc727573d7a1326c1::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInitdfef9ef856eed45fc727573d7a1326c1::$fallbackDirsPsr4;

        }, null, ClassLoader::class);
    }
}
