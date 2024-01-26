<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit3a1d1d6ffb9bff954219fd23e8bd8cd6
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

        spl_autoload_register(array('ComposerAutoloaderInit3a1d1d6ffb9bff954219fd23e8bd8cd6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit3a1d1d6ffb9bff954219fd23e8bd8cd6', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit3a1d1d6ffb9bff954219fd23e8bd8cd6::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit3a1d1d6ffb9bff954219fd23e8bd8cd6::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire3a1d1d6ffb9bff954219fd23e8bd8cd6($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire3a1d1d6ffb9bff954219fd23e8bd8cd6($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
