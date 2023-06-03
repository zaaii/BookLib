<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcda96d25627fa172750819a70a54e31e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcda96d25627fa172750819a70a54e31e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcda96d25627fa172750819a70a54e31e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcda96d25627fa172750819a70a54e31e::$classMap;

        }, null, ClassLoader::class);
    }
}
