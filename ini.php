<?php
header('Content-Type: text/html; charset=utf-8');
if(!file_exists('./Install/install.lock')) {
   header('Location:./Install');
   exit();
}

error_reporting(7);
define('SITE_URL',"http://{$_SERVER["SERVER_NAME"]}/");
define('ROOT', dirname(__FILE__).'/');
define('CHARSET', 'UTF-8');
define('TIME',time());
define('THINK_PATH',ROOT.'/ThinkPHP/');
define('PUBLIC_URL','public/');
require THINK_PATH.'ThinkPHP.php';
