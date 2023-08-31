
<?php

require_once ('../model/dao/hospedeiroDao.php');
require_once ('../model/bean/hospedeiroBean.php');
require_once ('utils.php');


class HospedeiroController{


public function __construct() {


  
    $acao = $_POST['acao'];
    if($acao == "bus") {
       $this->busca();
     
    }

    if($acao == "cad") {
      $this->cadastrar();
    }

  }


  public function busca() {


              $util = new Utils();
              $hospDao = new  HospedeiroDao();

              $lista2 = $hospDao->lista();

              $soma = 0;
                $i = 0;

             // echo "Error: ".$lista2->codon;
           $hosp = new Hospedeiro();
           $hospDao = new  HospedeiroDao();

            // preenche campo numero_codon
             $j=0;
             foreach ($lista2 as $value){

                  $numero[$j] = $util->calc_num($value['codon']);

                // echo "==".$numero[$j]."==";

                  $aux = $hosp->setCodon_numero($numero[$j]);


                   //echo 'aux: '.$hosp->getCodon_numero();
                   $numeros[$j] = $hosp->getCodon_numero();

                   //echo $numeros[$j];
                 
                  $hosp->setId($j+1);
                 // $hospDao->altera($hosp);
                 
                  $j++;               
             }

 

            $j=0;
             foreach ($lista2 as $value){

                $norma = sqrt($value['frequencia']);

                echo $frequenciaN[$j] = $value['frequencia']/$norma;

                exit();

                  $aux = $hosp->setCodon_numero($numero[$j]);

                   $hosp->setFrequencia_normalizada($frequenciaN[$j]);


             
                 
                  $hosp->setId($j+1);
                  //$hospDao->altera($hosp);
                 
                  $j++;               
             }



                         

               


            //echo "Teste: ".$B[7];

              $_REQUEST['lista2'] = $lista2 ;
              require_once '../view/tabela.php';


  }

   
}
 
new HospedeiroController();

?>
