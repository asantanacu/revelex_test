<?php

namespace Revelex\Services;

class Template{
    private $app; 
    private $view;
	private $layout;
	private $block = []; 
    private $config = [];
    public function __construct(array $config, $app){
        if(empty($config)){
            throw new \InvalidArgumentException(
                'template class requires at least one runtime options'
            );
        }
        
        $this->app = $app;
        $this->config = $config;
    }
    public function view($view, array $vars = []){  
        $app = $this->app;
        if($this->view === null){
            extract($vars, EXTR_SKIP);
           if(file_exists($view = $this->config['path'] . $view . '.php')){
                 $this->view = $view;      
                require $view; 
           }
        
        }
        return $this;
    }

    public function extend($view){
        $this->layout = $this->config['path'] . $view . '.php'; 
        return $this; 
    }
	
    public function content($name){
        if(array_key_exists($name, $this->block)){
            return $this->data; 
        }
    }

    public function block($name){
         $this->block[$name] = $name; 
        ob_start();
    }
    public function endblock($name){
         if(!array_key_exists($name, $this->block)){
            throw new \Exception; 
        }
        
        $app = $this->app;
        $this->data = ob_get_contents();
        ob_end_clean();      
        require $this->layout;
    }	
}
