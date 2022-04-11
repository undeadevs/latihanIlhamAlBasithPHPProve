<?php

    class BukuTamuModel{
        private $table='guestbook';
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function addToDB($name, $email, $message){
            $con = $this->db->getConnection();
            $statement = $con->prepare('INSERT INTO '.$this->table.' (id, name, email, message) VALUES (?,?,?,?)');
            $statement->bind_param('ssss', $_id, $_name, $_email, $_message);
            $_id = uniqid($this->table);
            $_name = $name;
            $_email = $email;
            $_message = $message;
            $res=$statement->execute();
            if($res===TRUE){
                return true;
            }else{
                die("Error: $statement <br> $con->error");
            }

            $statement->close();
        }

        public function getAll($limit=0, $offset=0){
            $queryOptions =$limit<=0?'':' LIMIT '.$limit;
            $queryOptions .=$queryOptions===''?'':' OFFSET '.$offset;
            $con = $this->db->getConnection();
            $res=$con->query('SELECT * FROM '.$this->table.$queryOptions);
            if($res->num_rows>0){
                $rows = [];
                while($row = $res->fetch_assoc()){
                    array_push($rows,$row);
                }
                return $rows;
            }
            return null;
        }

        public function getRowCount(){
            $con = $this->db->getConnection();
            $res=$con->query('SELECT COUNT(id) as `count` FROM '.$this->table);
            if($res->num_rows>0){
                return $res->fetch_assoc()['count']+0;
            }
            return null;
        }
    }