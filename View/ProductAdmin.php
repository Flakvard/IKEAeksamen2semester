<?php
	session_unset();
	require_once  '../Controller/productController.php';		
    $controller = new eventController();	
    $controller->mvcHandler();
?>