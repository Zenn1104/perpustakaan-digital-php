<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3bdadc11e03d642c173015c09b519d22
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'BasoMAlif\\PerpustakaanDigitalUkk\\' => 33,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'BasoMAlif\\PerpustakaanDigitalUkk\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit3bdadc11e03d642c173015c09b519d22::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3bdadc11e03d642c173015c09b519d22::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3bdadc11e03d642c173015c09b519d22::$classMap;

        }, null, ClassLoader::class);
    }
}