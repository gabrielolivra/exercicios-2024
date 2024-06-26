<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitebdf7b0ebceeb09d70e9aa855cf9a73f
{
    public static $prefixLengthsPsr4 = array (
        'B' =>
        array (
            'Box\\Spout\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Box\\Spout\\' =>
        array (
            0 => __DIR__ . '/..' . '/box/spout/src/Spout',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitebdf7b0ebceeb09d70e9aa855cf9a73f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitebdf7b0ebceeb09d70e9aa855cf9a73f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitebdf7b0ebceeb09d70e9aa855cf9a73f::$classMap;
        }, null, ClassLoader::class);
    }
}
