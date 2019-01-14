<?php

class View {

    function __construct() {
    }
    
    public function render($name, $noInclude=false){
     $path='views/'.$name.'.php';
      if(strpos($name,"html")>-1){
         $path='views/'.$name;
      }
       if($noInclude==true){
             require $path;
        }else{
             require $path;
             require $path;
             require$path;
        }
       
    }
}
