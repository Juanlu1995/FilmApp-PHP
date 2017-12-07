<?php
require_once '../vendor/autoload.php';

require_once '../helper.php';
dameDato($_SERVER);

use Phroute\Phroute\RouteCollector;
use Illuminate\Database\Capsule\Manager as Capsule;

$baseDir = str_replace(
    basename($_SERVER['SCRIPT_NAME']),
    "",
    $_SERVER['SCRIPT_NAME']
);

$baseUrl = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? 'https://'.$_SERVER['HTTP_HOST'].$baseDir : 'http://'.$_SERVER['HTTP_HOST'].$baseDir;

define('BASE_URL',$baseUrl);


if(file_exists(__DIR__.'../.env')){
    $dotenv = new Dotenv\Dotenv(__DIR__.'/..');
    $dotenv->load();
}
// Instancia de Eloquent
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$route = $_GET['route'] ?? "/";

$router = new RouteCollector();

$router->controller("/",App\Controllers\HomeController::class);
$router->controller("/films", App\Controllers\FilmsController::class);
//$router->controller("/users", App\Controllers\UsersController::class);
//$router->controller('/api', App\Controllers\ApiController::class);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$response = $dispatcher->dispatch($method,$route);

echo $response;