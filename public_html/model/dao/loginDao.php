<?php

require_once("conexao.php");

class LoginDao{
    
        public function __construct(){
            $this->con = new Conexao();
            $this->pdo = $this->con->conectar();
        }


     public function login($login, $senha) {     

              try {
                  // $stmt = $this->pdo->prepare('SELECT * FROM usuarios where login = :login and senha = :senha');
                   $stmt = $this->pdo->prepare('SELECT * FROM usuarios where login = "'.$login.'" and senha = "'.$senha.'"');
                  //echo "query1: ".$stmt->queryString;

                  
                  // depois verificar
                  $param = array(
                     
                  );
            
                  $stmt->execute();

                  //echo "query1: ".$stmt->queryString;
                  //exit();


                  return $stmt->fetchAll(PDO::FETCH_ASSOC);
         
              }catch(PDOException $e) {
                  echo "Erro: {$e->getMessage()}";
              }
          }


           public function cadastra($login, $senha, $perfil) {

            try {
                    $stmt = $this->pdo->prepare('INSERT INTO usuarios (login, senha,perfil) VALUES (:login,:senha, :perfil)');
                    
                    $param = array(
                        ':login'=> $login,
                        ':senha'=> $senha,
                        ':perfil'=> $perfil            
                    );
                    
                    return $stmt->execute($param);
                
                }catch(PDOException $e) {
                    echo "Erro: {$e->getMessage()}";
                }
        }


          public function deleta($usuario) {

            try {
                    $stmt = $this->pdo->prepare('DELETE FROM resultado_temp WHERE id_usuario = '.$usuario);
                    
                    
                    return $stmt->execute();

                  //    echo "query1: ".$stmt->queryString;
                  // exit();
                
                }catch(PDOException $e) {
                    echo "Erro: {$e->getMessage()}";
                }
        }




}

?>