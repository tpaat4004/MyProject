<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load biến môi trường từ file .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once "controller/ProductController.php";
require_once "controller/CategoryController.php";
require_once "controller/UserController.php";
require_once "controller/ColorController.php";
require_once "controller/SizeController.php";
require_once "controller/VariantController.php";
require_once "controller/CartController.php";
require_once "controller/CouponController.php";
require_once "controller/OrderController.php";
require_once "controller/FavouriteController.php";  

require_once "router/Router.php";
require_once "middleware.php";



$router = new Router();
$categoryController = new CategoryController();
$productController = new ProductController();
$userController = new UserController();
$colorController = new ColorController();
$sizeController = new SizeController();
$variantController = new VariantController();
$cartController = new CartController();
$couponController = new CouponController();
$orderController = new OrderController();
$favouriteController = new FavouriteController();

$router->addMiddleware('logRequest');


//users
$router->addRoute("/users", [$userController, "index"], ['isAdmin']);
$router->addRoute("/users/create", [$userController, "create"], ['isAdmin']);
$router->addRoute("/users/{id}", [$userController, "show"], ['isAdmin']);
$router->addRoute("/users/edit/{id}", [$userController, "edit"], ['isAdmin']);
$router->addRoute("/users/delete/{id}", [$userController, "delete"], ['isAdmin']);
$router->addRoute("/profile", [$userController, "profile"], ['isUser']);



//categories
$router->addRoute("/categories", [$categoryController, "index"], ['isAdmin']);
$router->addRoute("/categories/create", [$categoryController, "create"], ['isAdmin']);
$router->addRoute("/categories/{id}", [$categoryController, "show"], ['isUser']);
$router->addRoute("/categories/edit/{id}", [$categoryController, "edit"], ['isAdmin']);
$router->addRoute("/categories/delete/{id}", [$categoryController, "delete"], ['isAdmin']);


//products
$router->addRoute("/product", [$variantController, "index"], ['isAdmin']);
$router->addRoute("/product/add", [$variantController, "create"], ['isAdmin']);
$router->addRoute("/product/edit/{id}", [$variantController, "edit"], ['isAdmin']);
$router->addRoute("/product/delete/{id}", [$variantController, "delete"], ['isAdmin']);


$router->addRoute("/products", [$productController, "index"], ['isAdmin']);
$router->addRoute("/products/create", [$productController, "create"], ['isAdmin']);
$router->addRoute("/products/{id}", [$productController, "show"], ['isUser']);
$router->addRoute("/products/edit/{id}", [$productController, "edit"], ['isAdmin']);
$router->addRoute("/products/delete/{id}", [$productController, "delete"], ['isAdmin']);
$router->addRoute("/products/delete-image/{id}", [$productController, "deleteImage"], ['isAdmin']);

//home
$router->addRoute("/shop", [$productController, "shop"]);
$router->addRoute("/product_detail/{id}", [$productController, "list"]);
$router->addRoute("/product_detail/{id}", [$productController, "detail"]);



//colors
$router->addRoute("/colors", [$colorController, "index"], ['isUser']);
$router->addRoute("/colors/create", [$colorController, "create"], ['isAdmin']);
$router->addRoute("/colors/{id}", [$colorController, "show"], ['isUser']);
$router->addRoute("/colors/edit/{id}", [$colorController, "edit"], ['isAdmin']);
$router->addRoute("/colors/delete/{id}", [$colorController, "delete"], ['isAdmin']);


//sizes
$router->addRoute("/sizes", [$sizeController, "index"], ['isUser']);
$router->addRoute("/sizes/create", [$sizeController, "create"], ['isAdmin']);
$router->addRoute("/sizes/{id}", [$sizeController, "show"], ['isUser']);
$router->addRoute("/sizes/edit/{id}", [$sizeController, "edit"], ['isAdmin']);
$router->addRoute("/sizes/delete/{id}", [$sizeController, "delete"], ['isAdmin']);

//auth
$router->addRoute("/login", [$userController, "login"]);

$router->addRoute("/logout", [$userController, "logout"]);
$router->addRoute("/register", [$userController, "register"]);
$router->addRoute("/google/login", [$userController, "googleLogin"]);
$router->addRoute("/google/callback", [$userController, "googleCallback"]);
$router->addRoute("/forgot_password", [$userController, "forgotPassword"]);
$router->addRoute("/reset_password", [$userController, "resetPassword"]);

//carts
$router->addRoute("/carts", [$cartController, "index"]);
$router->addRoute("/carts/delete/{id}", [$cartController, "delete"]);
$router->addRoute('/carts/addToCart', [$cartController, "AddToCart"]);
$router->addRoute('/carts/update', [$cartController, "updateCart"]);


//coupons
$router->addRoute("/coupons", [$couponController, "index"], ['isAdmin']);
$router->addRoute("/coupons/create", [$couponController, "create"], ['isAdmin']);
$router->addRoute("/coupons/{id}", [$couponController, "show"], ['isAdmin']);
$router->addRoute("/coupons/edit/{id}", [$couponController, "edit"], ['isAdmin']);
$router->addRoute("/coupons/delete/{id}", [$couponController, "delete"], ['isAdmin']);

//Order
$router->addRoute("/orders", [$orderController, "checkout",], ['isUser']);
$router->addRoute("/orders/create", [$orderController, "checkout"], ['isUser']);
$router->addRoute("/orders/success", [$orderController, "success"], ['isUser']);
$router->addRoute("/orders/list", [$orderController, "listOrder"], ['isAdmin']);
$router->addRoute("/orders/detail", [$orderController, "OrderDetail"], ['isAdmin']);
$router->addRoute("/orders/update-status", [$orderController, "updateOrderStatus"], ['isAdmin']);
$router->addRoute("/orders/apply-Coupon", [$orderController, "applyCoupon"], ['isUser']);
$router->addRoute("/orders/remove-Coupon", [$orderController, "removeCoupon"], ['isUser']);
$router->addRoute("/orders/delete/{id}", [$orderController, "delete"], ['isUser']);
$router->addRoute("/orders/history", [$orderController, "orderHistory"], ['isUser']);
$router->addRoute("/orders/details", [$orderController, "orderDetailhistory"], ['isUser']);
$router->addRoute("/orders/tracking", [$orderController, "trackingOrder"]);
$router->addRoute("/orders/vnpay_payment", [$orderController, "vnpay_payment"]);
$router->addRoute("/orders/vnpay_return", [$orderController, "vnpay_return"]);
$router->addRoute("/orders/cancel", [$orderController, "cancelOrder"], ['isUser']);
$router->addRoute("/dashboard", [$orderController, "getRevenueData"], ['isAdmin']);


$router->addRoute("/favourite", [$favouriteController, "index"], ['isUser']);
$router->addRoute("/favourite/add/{id}", [$favouriteController, "add"], ['isUser']);
$router->dispatch();
?>