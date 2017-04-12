<?php

set_time_limit(0);
$delimeter = '';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$content_dir = explode($delimeter, dirname(__FILE__));

array_pop($content_dir);
$content_dir = implode($delimeter, $content_dir) . $delimeter;

chdir($content_dir);

$defines_file = '../includes/properties.php';

if (file_exists($defines_file)) {
    require($defines_file);
}

if (isset($_SERVER['REMOTE_ADDR'])) {
    die('Command Line Only!');
} else {
    $_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI'] = $argv[1];
}

require $content_dir . 'index.php';
?>



