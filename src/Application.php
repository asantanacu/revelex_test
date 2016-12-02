<?php

namespace Revelex;

Class Application extends Container{
      
    public function escape($text){
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    public function app($key, $value = null){
        if(null === $value){
            return $this->offsetGet($key); 
        }
        $this->offsetSet($key, $value); 
    }

    private function controllerDipatcher($resource){
        $controller = $resource['controller']; 
        $method     = $resource['method']; 
        $args       = $resource['args']; 
        $controller = "Revelex\Controllers\\".$resource['controller']; 
        
        if(!class_exists($controller)){
			throw new \Exception("controller $controller does not exist");
        }
        $controller = new $controller; 
        if(!method_exists($controller, $method)){
			throw new \Exception("method $method does not exist in $controller"); 
		}
        
		$controller->$method($args, $this);
		
    }
    public function view($block, array $variables = []){
        $this['view']->view($block, $variables);
    }

    public function run(){
        $resource = $this['route']->match($_SERVER, $_POST);  
        if(is_array($resource)){
			if(isset($resource['handler']))
				call_user_func_array($resource['handler'], [$resource['args'], $this]);
			else
				$this->controllerDipatcher($resource);

        }
    }
}
