<?php

require_once("conexao.php");

class PaisDao{
    
        public function __construct(){
            $this->con = new Conexao();
            $this->pdo = $this->con->conectar();
        }

    


        public function lista() {
                
            try {
                $stmt = $this->pdo->prepare( 'select * from pais' );
                
                 $stmt->execute();


                 $result = $stmt->fetchAll(); 


                 return $result;
            
            }catch(PDOException $e) {
                echo "Erro: {$e->getMessage()}";
            }
        }



}

?>