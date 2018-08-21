<?php
/**
 * Takes control from FrontController's index.php
 * Defines the  class controller and action and calls the desired method
 */
class Router 
{
    /**
     * @var array $routes  store routes
     */
    private $routes;
    
    public function __construct() // reads and saves routes
    { 
        $routesPath= ROOT.'/config/routes.php';//routes path
        $this->routes = include($routesPath);
        
    }
    
    /**
     * Return request string
     */
    
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
           //function substr to cut (if necessary) the non-query string's part 
            $str = trim($_SERVER['REQUEST_URI'], '/');
            return substr($str, 15);
            
            //return trim($_SERVER['REQUEST_URI'], '/'); //or that if cut nothing
        }
    }

/**
 * Get a query string. 
 * Defines the controller and action and calls the desired method
 */
    public function run()
    {
        //Get request string
        $uri = $this->getURI();
       
        //Check the existence of such a request in routes.php
        foreach ($this->routes as $uriPattern => $path) {
            
            //Looks for matches
            if (preg_match("~^$uriPattern$~", $uri)){
            //get the internal path from the outside according to the rule of routes.php
              //set matches in $path ($1 or $2) 
                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);
                
            //Find controller и action and indicate params
              
                $segments = explode('/', $internalRoute);
                
                $controllerName = array_shift($segments).'Controller';//Cut class name
                $controllerName = ucfirst($controllerName);
                
                $actionName = 'action'.ucfirst(array_shift($segments));// Cut action name
                
                $parameters = $segments;//what's left in the array after cutting
                
                //Include class from controller
                $controllerFile = ROOT . '/controllers/' .
                        $controllerName .'.php';
                
                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                
                //Create object
                $controllerObject = new $controllerName;
                
                //call function with params-variables
                $result = call_user_func_array(array (
                          $controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
            }
        }
    }
}
