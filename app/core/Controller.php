<?php

    class Controller{
        public function render($view,$locals=[]){
            if(file_exists("../app/views/$view.php")){
                $locals['flash']=$_SESSION['flash'];
                require_once("../app/views/$view.php");
            }
            $_SESSION['flash']=[];
            die();
            return;
        }
        public function redirect($url='#', $redirectTime=0, $message=''){
            $url = trim(htmlspecialchars($url),'/');
            header('Refresh: '.$redirectTime.'; url='.str_replace('?'.$_SERVER['QUERY_STRING'], '', str_replace(isset($_SERVER['PATH_INFO'])?ltrim($_SERVER['PATH_INFO'],"/"):"","",$_SERVER['REQUEST_URI'])).$url);
            die($message);
            return;
        }
        public function model($modelName){
            require_once('../app/models/'.$modelName.'.php');
            return new $modelName();
        }
        public function flash($type, $message){
            $_SESSION['flash']=[];
            $_SESSION['flash'][$type]=$message;
            return $this;
        }
    }