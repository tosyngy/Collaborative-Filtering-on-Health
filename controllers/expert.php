<?php

class Expert extends Controller{

    function __construct() {
        parent::__construct();
       }

            function index(){ 
       //  echo json_encode($this->model-> getTree());
         $this->view-> render("expert/index",TRUE);
        }
       

//     function tools(){ 
//       //  echo json_encode($this->model-> getTree());
//         $this->model-> getTree();
//        }
//     function symptoms(){ 
//       //  echo json_encode($this->model-> getTree());
//         $this->model-> symptoms();
//        }
//     function illness(){ 
//       //  echo json_encode($this->model-> getTree());
//         $this->model-> illness();
//        }
//     function saveSymptoms(){ 
//         if(!empty($_POST)){
//                   $this->model-> saveSymptoms($_POST);
//         }
//       }

}
