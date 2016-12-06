<?php

namespace Revelex\Services;

class Session{
    public function __construct(){
        if(!session_id())
			session_start();
    }
    public function set($key, $value){
        $_SESSION[$key] = $value;
    }
    public function get($key){
        if(array_key_exists($key, $_SESSION)){
            return $_SESSION[$key]; 
        }
        return FALSE;
    }
    public function delete($key){
        unset($_SESSION[$key]);
    }
    public function regenerate(){
        session_regenerate_id(TRUE);
        return session_id();
    }
    public function destroy(){
    	session_destroy(); 
    }
}