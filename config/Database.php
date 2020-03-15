<?php

    class Database{
        private $host = 'localhost';
        private $dbName = 'myblog';
        private $username = 'root';
        private $password = '';

        private $connect;

        public function __construct(){
            
            try{
                $this->connect = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(Exception $e){
                echo 'db connection error '. $e->getMessage();
            }
             return $this->connect;
        }

        public function queryDB($query, $params){
            //prepare query
            $stmt = $this->connect->prepare($query);
    
            $stmt->execute($params);
            return $stmt;
    
        }

    }


?>