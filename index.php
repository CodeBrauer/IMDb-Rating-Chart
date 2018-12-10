<?php
require 'vendor/autoload.php';
require_once 'app/Helper.php';
require_once 'app/View.php';
require_once 'app/OMDB.php';

use IMDBRC\View;
use IMDBRC\Helper;

define('APPPATH', str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__FILE__)) . '/');

(new Dotenv\Dotenv(__DIR__))->load();

$db = new Medoo\Medoo([
    'database_type' => getenv('DATABASE_TYPE'),
    'database_name' => getenv('DATABASE_NAME'),
    'server'        => getenv('SERVER'),
    'username'      => getenv('USERNAME'),
    'password'      => getenv('PASSWORD'),
]);

$app = new Slim\App(['settings' => [
    'displayErrorDetails' => filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN),
    'debug'               => filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN)
]]);
$app->add(new \pavlakis\cli\CliRequest());

$app->get('/', function ($request, $response, $args) {
    $view = View::load('index');
    return $response->withStatus(200)->write($view);
});

$app->get('/rating/{title_id}', function ($request, $response, $args) {
    $view = View::load('chart', [
        'data'         => [],
        'series_title' => '',
    ]);
    return $response->withStatus(200)->write($view);
});

$app->get('/search/{query}', function ($request, $response, $args) {
    
});

$app->get('/data/{title_id}', function ($request, $response, $args) {
    
});

$app->run();