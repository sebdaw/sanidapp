<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit7da3cb362a2d2abe0b2e8e2273ae94e3
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

        spl_autoload_register(array('ComposerAutoloaderInit7da3cb362a2d2abe0b2e8e2273ae94e3', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit7da3cb362a2d2abe0b2e8e2273ae94e3', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit7da3cb362a2d2abe0b2e8e2273ae94e3::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
