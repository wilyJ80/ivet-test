<?php

require_once("conexao.php");

class EspecieDao{
    
        public function __construct(){
            $this->con = new Conexao();
            $this->pdo = $this->con->conectar();
        }

        



        public function lista() {
                
            try {
                $stmt = $this->pdo->prepare( 'select * from especie' );



                $param = array(
                    //':especie_id'=> $seq->getEspecie_id()
                    //':gene_id'=> $seq->getGene_id()
                    //':gene'=> $seq->getGene(),
                   // ':gene'=> $seq->getGene(),
                );
                
                 $stmt->execute();

 
        $result = $stmt->fetchAll(); 

        return $result;

              
       
            
            }catch(PDOException $e) {
                echo "Erro: {$e->getMessage()}";
            }
        }



}

?>