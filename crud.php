<?php 
require_once 'connection.php';
    abstract class Crud extends Connection{
        private $table;
        private $pdo;

        public function __construct($table){
            $this->table=$table;
            $this->pdo=parent::conexion(); //parent por que la clase connection es protected
        }

        public function getAll(){
            try{
                $stm=$this->pdo->prepare("SELECT * FROM $this->table");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function getID($id){
            try{
                $stm=$this->pdo->prepare("SELECT * FROM $this->table WHERE id=?");
                $stm->execute(array($id));
                return $stm->fecthAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
        public function delete($id){
            try{
                $stm=$this->pdo->prepare("DELETE FROM $this->table WHERE id=?");
                $stm->execute(array($id));
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        abstract function create();
        abstract function update();
    }
?>