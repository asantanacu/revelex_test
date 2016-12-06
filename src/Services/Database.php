<?php

namespace Revelex\Services;

use PDO;

class Database{
	private $connection = null;
	private $host = "localhost";
	private $dbname = "";
	private $user = "";
	private $password = "";
    
    public function __construct($conf){
        if(empty($conf)){
            throw new \InvalidArgumentException(
                'database class requires at least one runtime options'
            );
        }
        
        $this->host = $conf['host'];
		$this->database = $conf['database'];
		$this->username = $conf['username'];
		$this->password = $conf['password'];
    }
	
    public function getConnection(){	
		if ($this->connection === null) {
            $this->connection = new PDO(
                    'mysql:host='.$this->host.';dbname='.$this->database, 
                    $this->username, 
                    $this->password
                );
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION
            );
        }
		return $this->connection;
    }
	
}