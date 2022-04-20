<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf9bab46ba88b3c67972ea0238c969e36
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitf9bab46ba88b3c67972ea0238c969e36', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf9bab46ba88b3c67972ea0238c969e36', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInitf9bab46ba88b3c67972ea0238c969e36::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}