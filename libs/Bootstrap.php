<?php

class Bootstrap {

    function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        foreach ($url as $key => $value) {
            $url[$key]=  strtolower($url[$key]);
        }
          if (empty($url[0])) {
                $this->render("index");
            return false;
                   }else{ 
              $file = 'controllers/' . $url[0] . '.php';
            if (file_exists($file)) {
                require $file;
                $controller = new $url[0];
                $controller->loadModel($url[0]);
                if (isset($url[2])) {
                    if (method_exists($controller, $url[1])) {
                        $controller->{$url[1]}($url[2]);
                    } else {
                         $controller->index();
                    }
                } elseif (isset($url[1])) {
                     if (method_exists($controller, $url[1])) {
                          $controller->{$url[1]}();
                            } else {
                                $this->render($url[0]);
                            }
                } else {
                   $this->render($url[0]);
                 }
            } else {
                $this->render("index");
                return;
            }
    }
   }
    
    
    
    function render($param) {
      $file = 'controllers/' . $param . '.php';
        require $file;
        $controller = new $param();
        $controller->loadModel("$param");
        $controller->index();
        }

  

}