<?php 
session_start(); 
require_once("vendor/autoload.php");
//use Slim\Slim;
//use Hcode\Page;
use Hcode\Model\User;
use Hcode\Model\Categories;
$app = new \Slim\Slim();

$app->config('debug', true);
require_once 'site.php';
require_once 'admin.php';
require_once 'admin-user.php';
require_once 'admin-categories.php';
require_once 'admin-products.php';


$app->run();

 ?>