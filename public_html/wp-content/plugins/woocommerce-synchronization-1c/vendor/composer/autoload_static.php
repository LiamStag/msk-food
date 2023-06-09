<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita1f1ef123d5322c9151e2ecc1aaf53a7
{
    public static $files = array (
        '000b9c308d8cc91c2ae4225e62ac30d6' => __DIR__ . '/..' . '/it-for-free/array_column/src/array_column.php',
        '7b88577ab913611f157876f23c7145ff' => __DIR__ . '/../..' . '/admin/loader.php',
        '1c75689e7d49c89cac73a52e7a404c52' => __DIR__ . '/../..' . '/includes/filters.php',
        'b685c35ced57cea211546d0568040fc3' => __DIR__ . '/../..' . '/includes/actions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'I' => 
        array (
            'Itgalaxy\\Wc\\Exchange1c\\Includes\\' => 32,
            'Itgalaxy\\Wc\\Exchange1c\\ExchangeProcess\\' => 39,
            'Itgalaxy\\Wc\\Exchange1c\\Admin\\' => 29,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Itgalaxy\\Wc\\Exchange1c\\Includes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'Itgalaxy\\Wc\\Exchange1c\\ExchangeProcess\\' => 
        array (
            0 => __DIR__ . '/../..' . '/exchange-process',
        ),
        'Itgalaxy\\Wc\\Exchange1c\\Admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/admin',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita1f1ef123d5322c9151e2ecc1aaf53a7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita1f1ef123d5322c9151e2ecc1aaf53a7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
