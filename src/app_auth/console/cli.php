#!/usr/bin/env php
<?php
/**
 *
 * @author Jacky Zhang <myself.fervor@gmail.com>
 * @copyright 2014-2016 深圳市喂车科技有限公司 <http://www.weicheche.cn/>
 * Date: 3/26/16
 * Time: 11:26 AM
 */


use Phalcon\CLI\Console as ConsoleApp;

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

date_default_timezone_set('Asia/Shanghai');

// $debug = new \Phalcon\Debug();
// $debug->listen();

try {
    // 应用名称
    define('APP_NAME', 'app_auth');
    define('IN_CLI', true);
    /**
     * 环境 - ENVIRON
     * 可选值：production, preview, develop, test
     */

    // 参数处理
    $options = getopt('n:m:c:a:', ['ENVIRON:', 'VERSION:']);

    // 默认版本号
    $app_version = "v1.0";
    $arguments   = [];
    foreach ($options as $k => $v) {
        switch ($k) {
            case 'n':
                break;

            case 'm':
                break;

            case 'c':
                $arguments['task']   = $v;
                break;

            case 'a':
                $arguments['action'] = $v;
                break;

            case 'ENVIRON':
                $_SERVER['ENVIRON']  = $v;
                break;

            case 'VERSION':
                $app_version = $v;
                break;

            default:
                $arguments[] = $v;
        }
    }

    // 其他参数
    $params = $_SERVER['argv'];
    unset($params[0]);
    foreach ($params as $k => $v) {
        if ($v[0] == '-') {
            continue;
        }
        @list ($name, $value) = explode('=', $v);
        $arguments['params'][$name] = $value;
    }
    unset($params);

    // 
    if (isset($_SERVER['ENVIRON'])) {
        define('ENVIRON', $_SERVER['ENVIRON']);
    }

    define("APP_VERSION", $app_version);

    define("DS", DIRECTORY_SEPARATOR);

    define("APP_PATH", dirname(__DIR__) . DS . APP_VERSION . DS);

    define("BASE_PATH", dirname(dirname(APP_PATH)) . DS);

    define("LIBRARY_PATH", BASE_PATH . "library" . DS);

    define("DATA_PATH", BASE_PATH . "data" . DS);

    // Required for phalcon/incubator
    include APP_PATH . 'vendor/autoload.php';

    // Required for phalcon/incubator
    include LIBRARY_PATH . 'vendor/autoload.php';

    /**
     * Read the configuration
     */
    $config = include APP_PATH . "config/config.php";

    /**
     * Read services
     */
    include APP_PATH . "config/services.php";

    /**
     * Handle the request
     */
    $application = new \WPLib\Console\Application($di);

    $di->set('application', $application, true);

    $application->handle($arguments);

} catch (\Exception $e) {
    /**
     * 错误捕获处理
     */
    Logger::begin();
    Logger::error(sprintf("%s[%s]: %s", $e->getFile(), $e->getLine(), $e->getMessage()));
    Logger::error($e->getTraceAsString());
    Logger::commit();

    echo json_encode([
        'status' => 500,
        'info'   => '服务器繁忙！',
        'data'   => [],
    ]);
}
