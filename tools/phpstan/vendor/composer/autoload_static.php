<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit24e6f7b55593341e7ef394bd007296e1
{
    public static $files = array (
        '9b38cf48e83f5d8f60375221cd213eee' => __DIR__ . '/..' . '/phpstan/phpstan/bootstrap.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit24e6f7b55593341e7ef394bd007296e1::$classMap;

        }, null, ClassLoader::class);
    }
}
