<?php

namespace Revelex;

use Revelex\Http\Request;
use Revelex\Http\Response;
use Revelex\Routes\RouteManager;
use Revelex\Template;
use Revelex\Session;
use Revelex\Database;

class Container implements \ArrayAccess{
    protected $container = array();
    
    public function __construct($conf){
        		
        if(file_exists($conf)){
			$app = $this; 		
            require $conf;
        }

        $this['route'] = new RouteManager($this['app.route']);
		
        $this['view'] = new Template($this['app.view'], $this);	

        $this['request'] = new Request($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
		
        $this['response'] = new Response();
		
        $this['session'] = new Session();
		
		$this['database'] = new Database($this['app.database']);

    }
    public function offsetUnset($offset){}
    
    public function offsetGet($offset){
        if(array_key_exists($offset, $this->container) && 
            is_callable($this->container[$offset])){
            return $this->container[$offset]();
        }
        return $this->container[$offset];
    }
    
    public function offsetExists($offset){
        return array_key_exists($offset, $this->container);
    }
    public function offsetSet($offset, $value){
        if(strpos($offset, ':')){
            list($index, $subset) = explode(':', $offset, 2); 
            $this->container[$index][$subset] = $value; 
        }
        
        $this->container[$offset] = $value;
    }
}