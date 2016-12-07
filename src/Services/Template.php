<?php

namespace Revelex\Services;

class Template{
    private $view;
	private $layout;
	private $block = []; 
    private $config = [];
    public function __construct($config){
        if(!isset($config['view'])){
            throw new \InvalidArgumentException(
                'Template class requires view configuration'
            );
        }
        
        $this->config = $config['view'];
    }
    public function view($view, array $vars = []){  
        if($this->view === null){
            extract($vars, EXTR_SKIP);
           if(file_exists($view = $this->config['path'] . $view . '.php')){
                $this->view = $view;
                global $app;      
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
        
        $this->data = ob_get_contents();
        ob_end_clean(); 
        global $app;     
        require $this->layout;
    }	
}
