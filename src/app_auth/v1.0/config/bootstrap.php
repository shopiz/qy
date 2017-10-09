<?php
/**
 *
 * @author Jacky Zhang <myself.fervor@gmail.com>
 * @copyright 2014-2016 深圳市喂车科技有限公司 <http://www.weicheche.cn/>
 * Date: 2/3/16
 * Time: 12:09 AM
 */

// 应用名称
define('APP_NAME', 'app_auth');
/**
 * 环境
 * 可选值：production, develop, test
 */
if (isset($_SERVER['ENVIRON'])) {
    define('ENVIRON', $_SERVER['ENVIRON']);
}

define("DS", DIRECTORY_SEPARATOR);

define("APP_PATH", dirname(__DIR__) . DS);

define("BASE_PATH", dirname(dirname(APP_PATH)) . DS);

define("LIBRARY_PATH", BASE_PATH . "library" . DS);

define("DATA_PATH", BASE_PATH . "data" . DS);

/**
 * Read the configuration
 */
$config = include APP_PATH . "config/config.php";

/**
 * Read services
 */
$di = include APP_PATH . "config/services.php";

/**
 * Handle the request
 */
$application = new \WPLib\Mvc\Application($di);

$di->set('application', $application, true);
