<?php

    class BeritaModel{
        private $table='news';
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function addToDB($date, $title, $content){
            $con = $this->db->getConnection();
            $statement = $con->prepare('INSERT INTO '.$this->table.' (id, date, title, content) VALUES (?,?,?,?)');
            $statement->bind_param('ssss', $_id, $_date, $_title, $_content);
            $_id = uniqid($this->table);
            $_date = $date;
            $_title = $title;
            $_content = $content;
            $res=$statement->execute();
            $statement->close();
            if($res===TRUE){
                return $_id;
            }
            die($con->error);
        }

        public function getAll($limit=0, $offset=0){
            $queryOptions =$limit<=0?'':' LIMIT '.$limit;
            $queryOptions .=$queryOptions===''?'':' OFFSET '.$offset;
            $con = $this->db->getConnection();
            $res=$con->query('SELECT * FROM '.$this->table.' ORDER BY title ASC, date DESC'.$queryOptions);
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

        public function getByID($id){
            $con = $this->db->getConnection();
            $id=$con->real_escape_string($id);
            $res=$con->query('SELECT * FROM '.$this->table.' WHERE id=\''.$id.'\'');
            if($res->num_rows>0){
                return $res->fetch_assoc();
            }
            return null;
        }

        public function editByID($id, $newData=[]){
            if(is_array($newData)){
                $con = $this->db->getConnection();
                $queryArr = [];
                foreach ($newData as $col => $val) {
                    array_push($queryArr, $col.'=\''.$con->real_escape_string($val).'\'');
                }
                if(count($queryArr)>0){
                    $res=$con->query('UPDATE '.$this->table.' SET '.implode(', ', $queryArr).' WHERE id=\''.$id.'\'');
                    if($res===TRUE){
                        return $res;
                    }
                    die($con->error);
                }
            }
        }

        public function deleteByID($id){
            $con = $this->db->getConnection();
            $res=$con->query('DELETE FROM '.$this->table.' WHERE id=\''.$con->real_escape_string($id).'\'');
            if($res===TRUE){
                return $res;
            }
            die($con->error);
        }
    }