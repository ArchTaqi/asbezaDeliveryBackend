<?php
namespace App\Socket;
use PDO;
use PDOException;

class Database {
    //for remote
    // private $host = 'localhost';
    // private $db_name = 'mynanicollection_dev_test';
    // private $username= 'mynanicollection_coderbob';
    // private $password = 'p@ssmstock2';
    // private $conn;


//for localhost
    private $host = 'localhost';
    private $db_name = 'stock_management';
    private $username= 'root';
    private $password = '';
    private $conn;

    //Db connect 
    public function connect(){
        $this ->conn = null;

        try{

            $this->conn = new PDO('mysql:host=localhost;dbname='.$this->db_name.';charset=utf8',
            $this->username,$this->password);
            
            $this->conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            echo 'connection error ' .$e->getMessage();
        }

        return $this->conn;
    }
}

