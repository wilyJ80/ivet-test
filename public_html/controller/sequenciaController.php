<?php
require_once ('../model/dao/sequenciaDao.php');
require_once ('../model/dao/hospedeiroDao.php');
require_once ('../model/bean/sequenciaBean.php');
require_once ('utils.php');

class SequenciaController{

public function __construct() {

    if(isset($_POST['acao'])){

      $acao = $_POST['acao'];

    if($acao == "bus") {
       $this->buscaResul();
         
    }

    if($acao == "graf" and isset($_POST['check'])){
    $this->dadosGraficos();
    }
	

    if($acao == "cad") {
      $this->cadastrar();
    }

   if($acao == "exc" and isset($_POST['check'])) {

      $this->delete();
    }

    if($acao == "exc") {

      $this->delete();
    }


  }

    if(isset($_GET['acao2'])){

      $acao2 = $_GET['acao2'];

       if($acao2 == "busG") {
       $this->busca();
         
    }

     if($acao2 == "exc") {
      $this->delete();
    }

      if($acao2 == "alt") {
      $this->cadastrarNumeroCodon();
    }}

    if($acao == "busCDI") {
     $this->buscarCDI();
    }

  }

    
  public function cadastrarNumeroCodon(){



        $util = new Utils();
        $seq = new Sequencia();
        $seqDao = new  SequenciaDao();

        $lista = $seqDao->listaSeq();
        $array = $lista;
        $tam = $lista;

         array_walk_recursive($array, function ($item, $key) {
         global $tam;
          if ($key == 'tamanho') 
              $tam[] = $item;
         });
    
         $y= 0;
         while ( $y <= count($tam) ) {

               $tamanho= $tam[$y]['tamanho'];
               $seq = $tam[$y]['sequencia'];
              //echo '<p>';
               $id = $tam[$y]['id_sequencia'];               
             
               $x=0; 
               $condon = ""; 
            
               for($i=0; $i< $tamanho/3; $i++){
                    for($j=0; $j<3; $j++){
                        $B[$j] = $seq[$x];
                        $x++;
                    }
                    $numero = $util->calcula_numero_codon($B);
                    $condon = $condon.$numero.",";
               }
          
               $seqDao->altera(substr($condon, 0, -1),$id);
               $y++;
      }
              
  }


 public function buscaResul() {

        session_start();


           $usuario = $_SESSION['usuario'];

           $hosts = $_POST['host'];

          
            if(count($hosts) > 1){
                $str_hosts = implode(',', $hosts);
            }else{
                $str_hosts = $hosts[0];
            }
            
             $hostsDesc ="";
            if($str_hosts == 1){
               $hostsDesc = "Avian";
            }if($str_hosts == 2){
               $hostsDesc = "Human";
            }if($str_hosts == 3){
              $hostsDesc = "Swine";
            }

              $codonusage = $_POST['codonusage'];

          // echo "codonusage: ".$codonusage;

             //exit();

                

            //======= Continente =======

             //$continente = $_POST['continente'];
             $continente = $_POST['continente'];

            // echo 'continente: '.$continente;
            // exit();
          
            $id_continente = 0;
            if(count($continente) > 1){
                $id_continente = implode(',', $continente);
            }else{
                $id_continente = $continente[0];
            }


            // echo 'continente control: '.$continente;
            // exit();

            //======= Gene =======

            //$gene = isset($_POST['gene']);
            $gene = $_POST['gene'];



            //echo "Gene: ".$_POST['gene'];

            //exit();
            

            //======= Tratamento para o array de subtipos =======

            
                $p = 'H';
                $c= 'N';

               $str_subtipos = $p.$_POST['subtipo1'].$c.$_POST['subtipo2'];

               //die();


             if($gene == 1){
               $geneDesc = 'HA';
             }else{
               $geneDesc = 'NA';
             }


            
           //======= Período =======
            $data_inicial = $_POST['datainicial'];
            $data_final = $_POST['datafinal'];
            $periodo = $data_inicial."-".$data_final;


            //======= tamanho da sequencia =======
            $trechoinicial = $_POST['trechoinicial'];
            $trechofinal = $_POST['trechofinal'];
            $tamanhoSeq = $trechoinicial."-".$trechofinal;

     
           //========== Consulta o numero de sequencia ========================================

              $seq = new Sequencia();
              $seqDao = new  SequenciaDao();

             // echo "especie2: ".$hostsDesc;
              
            
               $seq->setEspecie_id($str_hosts);
               $seq->setGene_id($gene);
               $seq->setSubtipo($str_subtipos);

              if($id_continente == "0" || $id_continente == ""){
                  $id_continente = "";
              }
            
            // echo 'continente control: ';
            // print_r($continente);
            // exit();

              $lista = $seqDao->lista($seq, $data_inicial, $data_final, $id_continente);

              $qtd = count($lista);


          //========== Tratamento do Resultado temporario  ========================================

            if ($qtd > 0){

             $id = $seqDao->insereResul($hostsDesc,$geneDesc,$str_subtipos, $periodo, $tamanhoSeq, $qtd, $id_continente, $usuario);
            }
             
            

            // echo "id de cima: ".$id.'</br>';
            //  exit();

             $this->busca($id, $codonusage);

            $resultado = $seqDao->listaResul($usuario);

 
          // print_r($resultado);
          //  exit();

            $_SESSION['resul']=$resultado;
            header('Location: ../view/pesquisa.php');  

 } 

      
   
public function busca($id,$codonusage) {

  $hospDao = new HospedeiroDao();
  $seqDao = new SequenciaDao();
  $seq = new Sequencia();
  $util = new Utils();
  
  //ob_start();
  
    $id2= $id;


  $listaResul = $seqDao->listaResul2($id);
 

  //echo "Tamanho da lista: ".count($listaResul);

              $y= 0;
               while ( $y < count($listaResul) ) { 

                     $id = $listaResul[$y]['id_resultado'];
                     $trecho = $listaResul[$y]['tamanho_sequencia'];
                     $especie= $listaResul[$y]['especie'];
                     $gene = $listaResul[$y]['gene'];
                     $subtipo= $listaResul[$y]['subtipo'];
                     $ano= $listaResul[$y]['ano'];
                     $periodo = explode('-', $ano);
                     $regiao =  $trecho;
                     $trechoSelecionado = explode('-', $trecho);
                     $continente= $listaResul[$y]['id_continente'];

            
                       $hosts = 0;
                      if($especie == "Avian"){
                         $hosts = 1;
                      }if($especie  == "Human"){
                         $hosts = 2;
                      }if($especie  == "Swine"){
                        $hosts = 3;
                      }

                     //$hostsTemp = 2;

                    // echo "</br>host: ".$hosts;

                      $codGene = 0;
                      if($gene == "HA"){
                        $codGene = 1;
                      }if($gene == "NA"){
                        $codGene = 2;
                      }

                      $seq->setEspecie_id($hosts);
                      $seq->setGene_id($codGene);
                      $seq->setSubtipo($subtipo);

                       
                       //lista de sequencia
                      $lista = $seqDao->lista($seq, $periodo[0], $periodo[1], $continente);
                      //  var_dump($lista);
                      // echo"===============================================";
                       
                       $num_seq = count($lista);

                       //echo  $num_seq;

                      // exit();
     
  //echo "</br codonusage>". $codonusage;
            $listaHosp = $hospDao->listaPorEspecie($codonusage);

            foreach ($lista as $row) {

                 $trecho_selecionado =  $util->trecho_sequencia_selecionada($row['sequencia_numero'],$trechoSelecionado[0],$trechoSelecionado[1]);  

                 // echo "trecho: ".$trecho_selecionado;
                 //  echo "</br>";
                 //   echo "</br>";
                 
                 $accession = $row['accession'];
                 $pais = $row['id_pais'];
                //exit();


                //  ini_set('memory_limit', '256M');         
                  $freq_normalizada = $util->calcula_frequencia_normalizada($trecho_selecionado);

                  $freq = explode(',', $freq_normalizada);
                  //echo " qtd frenq: ". count($freq);
     
                 // $trecho = explode(',', $trecho_selecionado);
                 // echo " qtd trecho: ". count($trecho);
     

                  $cdi = $util->calcula_cdi($listaHosp,$freq);

                  $sql[] ='('.$id.',"'.$trecho_selecionado.'","'.$especie.'","'.$gene.'",'.$row['ano'].',"'.$freq_normalizada.'","'.$subtipo.'","'.$cdi.'","'.$regiao.'","'.$accession.'","'.$pais.'")'; 

                             
            }

            $seqDao->insereResul2($sql);

     //  echo"valor insert: ". $seqDao->insereResul2($sql);
//exit();
  
               $y++;
        }

        // ob_end_flush();
  }



   public function dadosGraficos(){

        session_start();

        $seqDao = new SequenciaDao();

        $id = $_POST['check'];

         $cores_= $_POST['cores'];


           if(count($cores_) > 1){
                $cores = '"'.implode('","', $cores_).'"';
            }else{
                $cores = $cores_[0];
            }

            $simbolo = $_POST['simbolo'];
            $anoinicial = $_POST['anoinicial'];
            $anofinal = $_POST['anofinal'];
            $cdiinicial = $_POST['cdiinicial'];
            $cdifinal = $_POST['cdifinal'];


         $resul = $seqDao->listaResulTemp($id);

         $_SESSION['cores']=$cores;
         $_SESSION['simbolo']=$simbolo;
         $_SESSION['anoinicial']=$anoinicial;
         $_SESSION['anofinal']=$anofinal;
         $_SESSION['cdiinicial']=$cdiinicial;
         $_SESSION['cdifinal']=$cdifinal;
         $_SESSION['resultado']=$resul;   
         header('Location: ../view/grafico.php');
  }




    public function delete(){

      session_start(); 
  
       $id = $_POST['check'];
       $usuario = $_SESSION['usuario'];
       if($id[0]=='on'){
        //remove o primeiro elemento de um array
         array_shift($id);
       }

      
       $seqDao = new  SequenciaDao();
       $seqDao->delete($id);
          
          $seqDao = new  SequenciaDao();
          $resul = $seqDao->listaResul($usuario);

          $_SESSION['resul']=$resul;

          header('Location: ../view/pesquisa.php');
    }


        public function buscarCDI(){

          session_start();

          $array_ids = $_SESSION['$array_ids'];  

          $cdiMin = $_POST['cdiMin'];
          $cdiMax = $_POST['cdiMax'];
          $anoMin = $_POST['anoMin'];
          $anoMax = $_POST['anoMax'];


          $seqDao = new  SequenciaDao();
          $resulCDI = $seqDao->buscaCDI($cdiMin, $cdiMax, $anoMin, $anoMax, $array_ids);


          //echo"tamanho". count($resulCDI);

          //echo ' Daiane Rose  ==  ';
          //header('Content-type: application/json');
          echo json_encode($resulCDI);
          
      }



}
 
new SequenciaController();

?>
