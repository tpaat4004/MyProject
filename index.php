<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once "Database.php";
$database = new Database();

$conn = $database->getConnection();

use Dotenv\Dotenv;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;


// Load biến môi trường từ file .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once __DIR__ . '/vendor/autoload.php';
require_once "router/Router.php";
require_once "middleware.php";
require_once "controller/AuthController.php";
require_once "controller/CategoryController.php";
require_once "controller/UserController.php";
require_once "controller/ProductController.php";
require_once "view/helpers.php";

require_once "router/Router.php";
require_once "middleware.php";


$router = new Router();
$authController = new AuthController();
$categoryController = new CategoryController();
$userController = new UserController();
$productController = new ProductController();




// $router->addMiddleware('logRequest');

$router->addRoute("/", [$productController, 'home']);

//auth
$router->addRoute("/login", [$authController, "login"]);

$router->addRoute("/logout", [$authController, "logout"]);
$router->addRoute("/register", [$authController, "register"]);
$router->addRoute("/google/login", [$authController, "googleLogin"]);
$router->addRoute("/google/callback", [$authController, "googleCallback"]);
$router->addRoute("/forgot_password", [$authController, "forgotPassword"]);
$router->addRoute("/reset_password", [$authController, "resetPassword"]);




//users
$router->addRoute("/users", [$userController, "index"]);

$router->addRoute("/users/create", [$userController, "create"], ['isUser']);
$router->addRoute("/about", [$userController, "show"], ['isUser']);
$router->addRoute("/course", [$userController, "courses"]);
$router->addRoute("/trainers", [$userController, "trainers"], ['isUser']);
$router->addRoute("/events", [$userController, "events"]);
$router->addRoute("/pricing", [$userController, "pricing"]);
$router->addRoute("/contact", [$userController, "contact"]);
$router->addRoute("/profile", [$userController, "profile"]);
$router->addRoute("/profile/update", [$userController, "updateProfile"]);    
$router->addRoute("/profile/update-password", [$userController, "updatePassword"]);


//detail product
$router->addRoute("/san-pham/{slug}", [$productController, "detailBySlug"]);





//Categories
$router->addRoute("/admin/categories", [$categoryController, "index"], ['isAdmin']);
$router->addRoute("/admin/categories/create", [$categoryController, "create"], ['isAdmin']);
$router->addRoute("/admin/categories/edit/{id}", [$categoryController, "edit"], ['isAdmin']);
$router->addRoute("/admin/categories/delete{id}", [$categoryController, "delete"], ['isAdmin']);

$router->addRoute("/admin/products", [$productController, "index"], ['isAdmin']);
$router->addRoute("/admin/products/create", [$productController, "create"], ['isAdmin']);
$router->addRoute("/admin/products/edit/{id}", [$productController, "edit"], ['isAdmin']);
$router->addRoute("/admin/products/delete{id}", [$productController, "delete"], ['isAdmin']);















$router->addRoute("/thank-you", function() {
    include __DIR__ . "/view/thank-you.php";

});

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
 
 

$router->dispatch();
?>