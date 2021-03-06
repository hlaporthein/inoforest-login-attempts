<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit040db8f5ac8f234b6f0eace5ffcd5671
{
    public static $files = array (
        'f5f7c46bb5dca7df1373fe411945fe9d' => __DIR__ . '/../..' . '/inc/hooks.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit040db8f5ac8f234b6f0eace5ffcd5671::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit040db8f5ac8f234b6f0eace5ffcd5671::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
