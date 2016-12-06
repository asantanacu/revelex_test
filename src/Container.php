<?php

namespace Revelex;

use Revelex\Http\Request;
use Revelex\Http\Response;
use Revelex\Services\RouteManager;
use Revelex\Services\Template;
use Revelex\Services\Session;
use Revelex\Services\Database;
use Revelex\Services\Config;

class Container implements \ArrayAccess{
    protected $container = array();
    
    public function __construct($conf_file){
        $app = $this;

        $this['config'] = function() use($conf_file){
            return new Config($conf_file);
        };

        $this['route'] = function() use($app){
            return new RouteManager($app['config']['route']);
        };
		
        $this['view'] = function() use($app){
            return new Template($app['config']['view'], $app);	
        };

        $this['request'] = function() { 
            return new Request($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
        };
		
        $this['response'] = function() {
           return new Response();
        };
		
        $this['session'] = function(){
            return new Session();
        };
		
		$this['database'] = function()use($app){
            return new Database($app['config']['database']);
        };

    }
    
    public function offsetGet($offset){
        if(array_key_exists($offset, $this->container) && 
            is_callable($this->container[$offset])){
            $this->container[$offset] = $this->container[$offset]();
        }
        return $this->container[$offset];
    }
    
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
}