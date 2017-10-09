<?php

!defined('APP_NAME') && define('APP_NAME', 'app_auth');

!defined('APP_VERSION') && define('APP_VERSION', 'v1.0');

!defined('DS') && define("DS", DIRECTORY_SEPARATOR);

!defined("APP_PATH") && define("APP_PATH", dirname(__DIR__) . DS);

!defined("BASE_PATH") && define("BASE_PATH", dirname(dirname(APP_PATH)) . DS);

!defined("LIBRARY_PATH") && define("LIBRARY_PATH", BASE_PATH . "library" . DS);

!defined("DATA_PATH") && define("DATA_PATH", BASE_PATH . "data" . DS);

!defined('ENVIRON') && define('ENVIRON', 'develop');

!defined('DEBUG_LEVEL') && define('DEBUG_LEVEL', 0);

!defined('IN_CLI') && define('IN_CLI', false);

if (extension_loaded('Memcached')) {
    $memcached_options = [
        Memcached::OPT_PREFIX_KEY => 'weicheche::fw::',
    ];
} else {
    $memcached_options = [];
}

// 自动加载
include __DIR__ . "/loader.php";

return new Phalcon\Config(
    array_replace_recursive(
        include LIBRARY_PATH . "/config/common.php",
        [
            'application' => [
                'app_id'           => 10100,
                'app_name'         => 'XXXX子系统',
                'secret'           => 'weicheche123',
                'showErrors'       => false,
                'baseUri'          => '/',
            ],
            'database' => [
                "adapter"     => "Mysql",
                "dbname"      => "weicheche",
                "charset"     => "utf8",
            ],
            'database_qy' => [
                "adapter"     => "Mysql",
                "dbname"      => "wecar_qy",
                "charset"     => "utf8",
            ],
            'mongo' => [
                'servers' => [
                ],
                'dbname'     => 'weicheche',
            ],
            'cache' => [
                'frontend' => [
                    'lifetime'    => 3600,
                ],
                'backend' => [
                    'client'       => [
                        'prefix' => 'weicheche::fw::',
                    ],
                    'lifetime' => 3600,
                ],
                'metadata' => [
                    'client' => $memcached_options,
                    'prefix' => 'weicheche::fw::',
                    'lifetime' => 86400,
                    // 'persistent' => false,
                ],
                'redis' => [
                    'servers' => [
                    ],
                    'prefix' => 'weicheche::',
                    'statsKey' => '',
                ],
                'session' => [
                    'prefix' => 'weicheche::qy::session::',
                    'auth'   => 'XEXeh1l6nT3wHL0z',
                    'statsKey' => '',
                ],
            ],
            'mq' => [
                'adapter' => 'Redis',
                'prefix'  => 'fw::mq::',
            ],
            'logger' => [
                'filename' => sprintf('%slogs/%s_%s/application%s.log', DATA_PATH, APP_NAME, APP_VERSION, IN_CLI ? '_console' : ''),
            ],
            'view' => [
                // 'layoutDir'        => BASE_PATH . 'views/common/',
                'themeDir'         => APP_PATH . 'views/',
                'mainView'         => 'index',
                'appName'          => APP_NAME,
                'cacheTime'        => 7200,
                'cacheDir'         => DATA_PATH . 'cache/' . APP_NAME . '/',
                'compiledDir'       => DATA_PATH . 'compiled/' . APP_NAME . '/',
                'defaultThemesDir' => 'default',
                'compileAlways'    => false,
            ],
        ],
        include __DIR__ . "/environ/" . ENVIRON . ".php"
    )
);
