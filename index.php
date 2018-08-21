<?php
//FRONT CONTROLLER => All files are redirected here

//Get a request, analyze it and transfer control to the right file


//1.General settings
ini_set('display_errors', 1);//enable error reporting
error_reporting(E_ALL);

//2. Connecting system files
define('ROOT', dirname(__FILE__));//get the full path

require_once (ROOT.'/components/Router.php');


//3. Connection to the database
require_once (ROOT.'/components/Db.php') ;

//4. Create Router and calls function run()
$router = new Router();
$router->run();


