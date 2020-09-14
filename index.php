<?php
ob_start();
session_start();

require "config.php";
require "classes/Helper.php";
require "classes/Validation.php";
require "classes/Bootstrap.php";
require "classes/Controller.php";
require "classes/Model.php";

require "controllers/home.php";
require "controllers/users.php";
require "controllers/todos.php";

require "models/home.php";
require "models/user.php";
require "models/todos.php";


$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();//create classes of files from file controllers

//if a class in the file controllers exists
if ($controller) {
	$controller->executeAction();
}
