<?php

require_once("conexao.php");

class ContinenteDao{
    
        public function __construct(){
            $this->con = new Conexao();
            $this->pdo = $this->con->conectar();
        }

    


        public function lista() {
                
            try {
                $stmt = $this->pdo->prepare( 'select * from continente' );

                 $stmt->execute();
                 echo "query: ".$stmt->queryString;

//exit();
                 $result = $stmt->fetchAll(); 


                 return $result;
            
            }catch(PDOException $e) {
                echo "Erro: {$e->getMessage()}";
            }
        }



}

?>