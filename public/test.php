<?php

trait SomeTrait {
	abstract public function sayHello();
	
	
}


class TestClass {

	static public  $secret = 12345;
	static public function sayHelloSt(){
        echo "Hello my secret is ".static::$secret;
    }
	static public function sayHelloSf(){
        echo "Hello my secret is ".self::$secret;
    }
}

class TestClass1 extends TestClass{
	
	static public $secret = 67890;
	
		static public function sayHelloSf(){
        echo "Hello my secret is ".self::$secret;
    }
}

TestClass::sayHelloSt();
TestClass::sayHelloSf();

TestClass1::sayHelloSt();
TestClass1::sayHelloSf();
?>
