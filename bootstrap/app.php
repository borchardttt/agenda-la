<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Router/Router.php';

use App\Router\Router;

$pdo = new PDO('mysql:host=database;dbname=agenda_la', 'root', 'agenda_la_adm_pwd');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

Router::init($pdo);
