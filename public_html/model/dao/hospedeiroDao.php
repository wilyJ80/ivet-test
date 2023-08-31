<?php

require_once("conexao.php");

class HospedeiroDao{
    
        public function __construct(){
            $this->con = new Conexao();
            $this->pdo = $this->con->conectar();
        }

        
          public function altera(Hospedeiro $hosp) {


            echo $hosp->getFrequencia_normalizada();

            
            try {
                    $stmt = $this->pdo->prepare('update hospedeiro_primario set  frequencia_normalizada = :freq_normalizada where id_hospedeiro = :id ');
                    
                    $param = array(
                        //':numero'=> $hosp->getCodon_numero(),
                        ':freq_normalizada'=> $hosp->getFrequencia_normalizada(),
                        ':id'=> $hosp->getId()

                    );
                    
                    return $stmt->execute($param);
                
                }catch(PDOException $e) {
                    echo "Erro: {$e->getMessage()}";
                }
        }



        public function lista() {     

            try {
                $stmt = $this->pdo->prepare('SELECT * FROM hospedeiro_primario');


                // depois verificar
                $param = array(
                    
                );

              $stmt->execute();

             return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
            
            }catch(PDOException $e) {
                echo "Erro: {$e->getMessage()}";
            }
        }


        public function listaPorEspecie($id) {    


     
            try {
                $stmt = $this->pdo->prepare('SELECT * FROM hospedeiro_primario where especie = '.$id);


              $stmt->execute();

             return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
            
            }catch(PDOException $e) {
                echo "Erro: {$e->getMessage()}";
            }
        }


}

?>