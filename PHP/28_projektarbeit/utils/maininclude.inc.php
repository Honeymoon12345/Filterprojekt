<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'db/dbconnection.inc.php';
require_once 'model/models.inc.php';
require_once 'service/userservice.inc.php';
require_once 'service/productservice.inc.php';


// DB-Connection erzeugen
$conn = db_connection();


//Objekt der Klasse UserService
$userService = new UserService($conn);

//Produkte 
$productService = new ProductService($conn);

?>


