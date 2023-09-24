<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita6d07f5245c4b1f91a297b319c403785
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

        spl_autoload_register(array('ComposerAutoloaderInita6d07f5245c4b1f91a297b319c403785', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita6d07f5245c4b1f91a297b319c403785', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita6d07f5245c4b1f91a297b319c403785::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
