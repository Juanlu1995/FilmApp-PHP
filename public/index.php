<?php
require_once '../vendor/autoload.php';

require_once '../helper.php';

use Phroute\Phroute\RouteCollector;
use Illuminate\Database\Capsule\Manager as Capsule;


session_start();
$baseDir = str_replace(
    basename($_SERVER['SCRIPT_NAME']),
    "",
    $_SERVER['SCRIPT_NAME']
);

$baseUrl = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? 'https://'.$_SERVER['HTTP_HOST'].$baseDir : 'http://'.$_SERVER['HTTP_HOST'].$baseDir;

define('BASE_URL',$baseUrl);

/**
 * Para que funcione tanto en local como en un servidor remoto, comprobamos que tengamos un archivo .env en nuestro proyecto,
 * si es así, lo carga.
 */

if(file_exists(__DIR__.'/../.env')){
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

/**
 *Creamos el filtro para los usuarios logueados
 */
$router->filter('auth',function (){
    if (!isset($_SESSION['userId'])){
        header('Location: ' . BASE_URL);
        return false;
    }
});
/**
 * Damos las rutas disponibles SÓLO para los usuarios logueados
 */
$router->group(['before'=>'auth'], function ($router){
    $router->get('/films/new', ['\App\Controllers\FilmsController', 'getNew']);
    $router->post('/films/new', ['\App\Controllers\FilmsController', 'postNew']);
    $router->get('/films/edit/{id}', ['\App\Controllers\FilmsController', 'getEdit']);
    $router->put('/films/edit/{id}', ['\App\Controllers\FilmsController', 'putEdit']);
    $router->delete('/films/', ['\App\Controllers\FilmsController', 'deleteIndex']);
    $router->get('/logout', ['\App\Controllers\HomeController', 'getLogout']);
});

/**
 * Creamos el filtro para los usuarios no registrados
 */
$router->filter('noAuth', function(){
    if( isset($_SESSION['userId'])){
        header('Location: '. BASE_URL);
        return false;
    }
});
/**
 * Creamos las rutas disponibles SÓLO para los usuarios NO logueados
 */
$router->group(['before' => 'noAuth'], function ($router){
    $router->get('/login', ['\App\Controllers\HomeController', 'getLogin']);
    $router->post('/login', ['\App\Controllers\HomeController', 'postLogin']);
    $router->get('/registro', ['\App\Controllers\HomeController', 'getRegistro']);
    $router->post('/registro', ['\App\Controllers\HomeController', 'postRegistro']);
});


// Rutas sin filtro
$router->get("/",['App\Controllers\HomeController','getIndex']);
$router->get("/films/{id}", ['App\Controllers\FilmsController', 'getIndex']);
$router->post("/films/{id}", ['App\Controllers\FilmsController', 'postIndex']);
$router->get("/404/{route}", ['App\Controllers\HomeController', 'get404']);

$router->controller('/api', App\Controllers\ApiController::class);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

/**
 * Probamos si recibimos alguna variable '_method'
 * Si existe, llamamos a la ruta con dicho metodo,
 * y si no existe, le damos al método el valor recibido en la variable superglobal '$_SERVER[REQUEST_METHOD]'
 *
 * Si salta la excepción de la ruta no encontrada creamos una nueva ruta hacia la página de error 404
 */
$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];
try {
    $response = $dispatcher->dispatch($method, $route);
}catch (\Phroute\Phroute\Exception\HttpRouteNotFoundException $ex){
    $response = $dispatcher->dispatch("GET", "/404/".$route);
}
echo $response;