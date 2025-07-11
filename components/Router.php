<?php

class Router {

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);

    }

    public function run() {
        
        // Отримати стрічку запиту

        $uri = trim($_SERVER["REQUEST_URI"], '/');
        // Відкинути query string (після ?)
        $uri = explode('?', $uri, 2)[0];
       

        // Перевірити наявність такого запиту в роутах(зонішній маршрут)

        foreach ($this->routes as $uriPattern => $path) {
           
            if(preg_match("~$uriPattern~", $uri)) {

                // Якщо є співадіння, визначити, який саме контролер та екшен
                // обробляє запит(внутрішній маршрут)

        
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

    

                $segments = explode('/',  $internalRoute);

        
               $controllerName = ucfirst(array_shift($segments)) . 'Controller';
               
               $actionName = 'action' . ucfirst(array_shift($segments));

            
                // Підключити файл класу котролера

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                include_once($controllerFile);

                // Створити об'єкт котролера, викликати його відповідний екшен

                $controllerObject = new $controllerName;

                // $result = $controllerObject->$actionName($segments);

                $result = call_user_func_array(array( $controllerObject, $actionName), $segments);


                if($result == true)
                    break;

            }

        }


      

    }

}