<?php
    class Database{
        private $host = DB_HOST;
        private $username = DB_USERNAME;
        private $password = DB_PASSWORD;
        private $db = DB_NAME;

        public function __construct(){
        }

        public function getConnection(){
            $con = new mysqli($this->host, $this->username, $this->password, $this->db);
            if($con->connect_error){
                die("Connection failed: $con->connect_error");
            }
            return $con;
        }
    }