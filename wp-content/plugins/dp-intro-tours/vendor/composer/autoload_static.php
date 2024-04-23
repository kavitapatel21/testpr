<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7e13fcbef29a59d03de00f18ba99249b
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'IntroToursWPackio\\' => 18,
            'IntroToursDP\\Wp\\' => 16,
            'IntroToursDP\\Std\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'IntroToursWPackio\\' => 
        array (
            0 => __DIR__ . '/..' . '/wpackio/enqueue/build',
        ),
        'IntroToursDP\\Wp\\' => 
        array (
            0 => __DIR__ . '/..' . '/deeppresentation/wordpress-std/build',
        ),
        'IntroToursDP\\Std\\' => 
        array (
            0 => __DIR__ . '/..' . '/deeppresentation/php-std/build',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'IntroToursDP\\Std\\Core\\Arr' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/Arr.php',
        'IntroToursDP\\Std\\Core\\Color' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/Color.php',
        'IntroToursDP\\Std\\Core\\Csv' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/Csv.php',
        'IntroToursDP\\Std\\Core\\GoogleGeo' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/GoogleGeo.php',
        'IntroToursDP\\Std\\Core\\Math' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/Math.php',
        'IntroToursDP\\Std\\Core\\Path' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/Path.php',
        'IntroToursDP\\Std\\Core\\Special' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/Special.php',
        'IntroToursDP\\Std\\Core\\Statistics' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/Statistics.php',
        'IntroToursDP\\Std\\Core\\Str' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/Str.php',
        'IntroToursDP\\Std\\Core\\Url' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Core/Url.php',
        'IntroToursDP\\Std\\Html\\Attr' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Html/Attr.php',
        'IntroToursDP\\Std\\Html\\Element' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Html/Element.php',
        'IntroToursDP\\Std\\Html\\Html' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Html/Html.php',
        'IntroToursDP\\Std\\Html\\Parse\\Dom' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Html/Parse/Dom.php',
        'IntroToursDP\\Std\\Html\\Parse\\DomNode' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Html/Parse/DomNode.php',
        'IntroToursDP\\Std\\Html\\Parse\\Helper' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Html/Parse/Helper.php',
        'IntroToursDP\\Std\\Process\\AjaxResp' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Process/AjaxResp.php',
        'IntroToursDP\\Std\\Process\\SprinkleProcess' => __DIR__ . '/..' . '/deeppresentation/php-std/build/Process/SprinkleProcess.php',
        'IntroToursDP\\Wp\\Acf' => __DIR__ . '/..' . '/deeppresentation/wordpress-std/build/Acf.php',
        'IntroToursDP\\Wp\\AdminNotice' => __DIR__ . '/..' . '/deeppresentation/wordpress-std/build/AdminNotice.php',
        'IntroToursDP\\Wp\\AdminPromo' => __DIR__ . '/..' . '/deeppresentation/wordpress-std/build/AdminPromo.php',
        'IntroToursDP\\Wp\\Ajax' => __DIR__ . '/..' . '/deeppresentation/wordpress-std/build/Ajax.php',
        'IntroToursDP\\Wp\\GoogleGeo' => __DIR__ . '/..' . '/deeppresentation/wordpress-std/build/GoogleGeo.php',
        'IntroToursDP\\Wp\\Settings' => __DIR__ . '/..' . '/deeppresentation/wordpress-std/build/Settings.php',
        'IntroToursDP\\Wp\\WpStd' => __DIR__ . '/..' . '/deeppresentation/wordpress-std/build/WpStd.php',
        'IntroToursWPackio\\Enqueue' => __DIR__ . '/..' . '/wpackio/enqueue/build/Enqueue.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7e13fcbef29a59d03de00f18ba99249b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7e13fcbef29a59d03de00f18ba99249b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7e13fcbef29a59d03de00f18ba99249b::$classMap;

        }, null, ClassLoader::class);
    }
}
