<?php
ini_set('display_errors', 'on');
session_start();
ob_start();
require_once './core/helpers.php';
require_once './core/database.php';
require_once './core/session.php';

// php mailer library
require 'assets/plugins/custom/phpMailer/Exception.php';
require 'assets/plugins/custom/phpMailer/PHPMailer.php';
require 'assets/plugins/custom/phpMailer/SMTP.php';
/*
 * --------------------------------------------------------------------
 * app path
 * --------------------------------------------------------------------
 */
$app_path = dirname(__FILE__);
define('APPPATH', $app_path);
/*
 * --------------------------------------------------------------------
 * library path
 * --------------------------------------------------------------------
 */
$lib_folder = 'libraries';
define('LIBPATH', APPPATH . DIRECTORY_SEPARATOR . $lib_folder);

/*
 * --------------------------------------------------------------------
 * config path
 * --------------------------------------------------------------------
 */
$config_folder = 'config';
define('CONFIGPATH', APPPATH . DIRECTORY_SEPARATOR . $config_folder);
/*
 * --------------------------------------------------------------------
 * modules path
 * --------------------------------------------------------------------
 */
$modules_folder = 'modules';
define('MODULESPATH', APPPATH . DIRECTORY_SEPARATOR . $modules_folder);
/*
 * --------------------------------------------------------------------
 * layout path
 * --------------------------------------------------------------------
 */
$layout_folder = 'layouts';
define('LAYOUTPATH', APPPATH . DIRECTORY_SEPARATOR . $layout_folder);
/*
 * --------------------------------------------------------------------
 * core path
 * --------------------------------------------------------------------
 */
$core_folder = 'core';
define('COREPATH', APPPATH . DIRECTORY_SEPARATOR . $core_folder);

require COREPATH . DIRECTORY_SEPARATOR . 'appload.php';
