<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce612bdc0ddd9019cae2f69160a33b81
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SiteGround_i18n\\' => 16,
            'SiteGround_Migrator\\' => 20,
            'SiteGround_Helper\\' => 18,
            'ShuttleExport\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SiteGround_i18n\\' => 
        array (
            0 => __DIR__ . '/..' . '/siteground/siteground-i18n/src',
        ),
        'SiteGround_Migrator\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'SiteGround_Helper\\' => 
        array (
            0 => __DIR__ . '/..' . '/siteground/siteground-helper/src',
        ),
        'ShuttleExport\\' => 
        array (
            0 => __DIR__ . '/..' . '/2createStudio/ShuttleExport/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Symfony\\Component\\Process' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/process',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce612bdc0ddd9019cae2f69160a33b81::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce612bdc0ddd9019cae2f69160a33b81::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitce612bdc0ddd9019cae2f69160a33b81::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitce612bdc0ddd9019cae2f69160a33b81::$classMap;

        }, null, ClassLoader::class);
    }
}