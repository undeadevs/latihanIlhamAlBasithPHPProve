<?php

    class App{
        protected $middlewares = [];
        protected $routes = [];
        public function __construct(){
            $this->path=isset($_SERVER['PATH_INFO'])?rtrim($_SERVER['PATH_INFO'],'/'):'/';
            $this->method=$_SERVER['REQUEST_METHOD'];
        }
        public function start(){
            $exist=false;
            $explodedPath = explode('/',$this->path);
            foreach ($this->middlewares as $middleware) {
                $middleware();
            }
            foreach ($this->routes as $route) {
                $this->params = [];
                $explodedRoutePath = explode('/',$route['path']);
                foreach ($explodedPath as $i=>$val) {
                    if(isset($route['params'][$i])){
                        $this->params[$route['params'][$i]]=filter_var($val, FILTER_SANITIZE_URL);
                        $explodedRoutePath[$i]='__';
                    }
                }
                if(count($this->params)===0 || count($this->params)!==count($route['params'])){
                    if($this->path===$route['path']&&strtoupper($this->method)===$route['method']){
                        foreach ($route['middlewares'] as $middleware) {
                            $middleware();
                        }
                        $route['controller']();
                        $exist=true;
                    }
                }else{
                    $regexPath = '/^'.preg_replace('/__/','(.+)',preg_quote(implode('/',$explodedRoutePath),'/')).'$/';
                    if(preg_match($regexPath,$this->path)&&strtoupper($this->method)===$route['method']){
                        foreach ($route['middlewares'] as $middleware) {
                            $middleware();
                        }
                        $route['controller']($this->params);
                        $exist=true;
                    }
                }
            }
            if(!$exist){
                http_response_code(404);
                die("<b>404</b>. Unable to do a <b>'$this->method'</b> request from <b>'$this->path'</b>");
            }
        }
        public function use($middleware){
            array_push($this->middlewares, $middleware);
        }
        public function get($path, $middlewares=[], $controller){
            $this->createRequestHandler('GET', $path, $middlewares, $controller);
        }
        public function post($path, $middlewares=[], $controller){
            $this->createRequestHandler('POST', $path, $middlewares, $controller);
        }
        public function delete($path, $middlewares=[], $controller){
            $this->createRequestHandler('DELETE', $path, $middlewares, $controller);
        }

        private function createRequestHandler($method, $path, $middlewares=[], $controller){
            $method = strtoupper($method);
            if(preg_match('/(GET|POST|DELETE)/', $method)){
                if(!isset($path) || !is_string($path)) return throw new Exception('Invalid Path');
                if(!isset($controller)) return throw new Exception('Invalid Controller');
                $explodedPath = explode('/',$path);
                $params = [];
                foreach ($explodedPath as $i=>$val) {
                    if(substr($val, 0, 1)===':'){
                        $params[$i]=ltrim($val,':');
                    }
                }
                array_push($this->routes,['path'=>strlen($path)>1?rtrim($path,'/'):$path,'method'=>$method, 'params'=>$params,'middlewares'=>$middlewares,'controller'=>$controller]);
            }
        }
    }