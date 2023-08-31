<?php

require_once ('../model/dao/loginDao.php');
//require_once('../model/dao/loginDao.php');
//require_once('./model/dao/loginDao.php');
// require_once('../model/dao/sequenciaDao.php');
// require_once('../model/bean/sequenciaBean.php');
require_once('utils.php');




class LoginController{

        
        public function __construct() {

            if(isset($_POST['acao'])){


              $acao = $_POST['acao'];

                if($acao == "aut") {
                   $this->autenticar();  
                }

                if($acao == "cad") {
                  $this->cadastrar();
                }


                 
            }
        }


        public function autenticar(){

            session_start();

             $loginDao = new LoginDao();

             $login = $_POST['login'];
             $senha = md5($_POST['senha']);


            $usuario = $loginDao->login($login, $senha);
         

          //echo "string: ".$usuario[0];
            //redirecionando para pagina conforme o tipo do usuário
            if ($usuario[0]['perfil'] == 1) {
               header("Location:../view/pesquisa2.php");
            } else if ($usuario[0]['perfil'] == 2) {

               $_SESSION['login'] = $usuario[0]['login'];
               $_SESSION['senha'] = $usuario[0]['senha'];
               $_SESSION['usuario'] = $usuario[0]['idusuarios'];
               header("Location:../view/sisaev.php");
            }
        }


       public function cadastrar(){

           session_start();

           $loginDao = new LoginDao();

           $login = $_POST['login'];
           $senha = md5($_POST['senha']);
           $perfil = $_POST['perfil'];

           $usuario = $loginDao->cadastra($login, $senha, $perfil);

           echo '<script> alert ("Usuario cadastrado com sucesso!"); location.href=("../index.php")</script>';
          
       }


       // public function delete($usuario){

       //          //echo "Daiane e Bruno";
       //        $loginDao = new LoginDao();
       //        $loginDao->deleta($usuario);
       // }

    
  }

 
new LoginController();

?>


