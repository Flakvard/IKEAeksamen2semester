<?php
	session_unset();
	require_once  '../Controller/eventController.php';		
    $controller = new eventController();	
    $controller->mvcHandler();
?>