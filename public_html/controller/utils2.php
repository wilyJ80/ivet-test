<?php
class Utils{
	

	function  trecho_sequencia_selecionada($sequencia, $posicaoInicial, $posicaoFinal){

                   
              $trecho = "";
              $array = explode(',', $sequencia);

               //$tamanho = count($array);
             //  echo 'tamanho === '.$tamanho;
             //  echo "<br>";
             // echo "<br>";
             // echo " tamanho vetor: ". count($array);

               // $pi= ceil( ($posicaoInicial*$tamanho)/100 );
               // $pf= ceil( ($posicaoFinal*$tamanho)/100 );

               // echo "posição inicial Dai: ".$pio;
               // echo " posição final Dai: ".$pfo;
               // echo "<br>";
               // echo "<br>";

               $tamanho=count($array)/3;
               $ci=floor(($posicaoInicial*$tamanho)/100)+1;
               $pi= 3*$ci-3;
               $cf=ceil(($posicaoFinal*$tamanho)/100);
               $pf= 3*$cf-1;  


              // $i= $pi-1;
              for($i = $pi; $i<$pf; $i++){
                   $trecho = $trecho.$array[$i].',';
              }
                 
              
                //retira a  ultima virgula
              return substr($trecho, 0, -1);

    }



    function nucletideo($base){
      $base_num=0;

              switch ($base) {

              case 'A':
                $base_num = 0;
                break;

              case 'G':
                $base_num = 1;
                break;

              case 'C':
                $base_num = 2;
                break;

              case 'T':
                $base_num = 3;
                break;
              
            }

            return $base_num;
    }


 //    function calcula_numero_codon($codon) {
 //      //$codon_num=0;
 // //print_r($codon);
 //          $codon_num = 1 + $this->nucletideo($codon[2]) + (4 * $this->nucletideo($codon[1])) + (16 * $this->nucletideo($codon[0]));

 //        // echo "=".$codon_num."=";
 //        // exit();
 //          return $codon_num;

 //    }


        function calcula_numero_codon($codon) {
       
            $cont = 0;

            for($i=0; $i<=2; $i++){

                    if($codon[$i] == 'A' || $codon[$i] == 'G' || $codon[$i] == 'C' || $codon[$i] == 'T'){
                        $cont++;
                    }
            }

            if ($cont == 3){
                $codon_num = 1 + $this->nucletideo($codon[2]) + (4 * $this->nucletideo($codon[1])) + (16 * $this->nucletideo($codon[0]));
            }else{
                $codon_num = 0;
            }

            return   $codon_num;
      }



    function calcula_frequencia_normalizada($trecho_selecionado){

            $soma = 0;
            $i = 0;
            $frenN = "";

          $arraycodon = explode(',', $trecho_selecionado);
         
          //Só para não precisar trazer a tabela de hospedeiro
          for($i=1; $i<=64;$i++){
               $frequencia[$i] = 0;          
          }


          //$codons_inexistentes = array_diff($v,$arraycodon);

          //$codons = array_merge($arraycodon, $codons_inexistentes);

          //asort($codons);

           // conta a  ocorrencia de cada numero de codon do trecho selecionado
           // for ($i=1;i<=64;$i++) {
              $qtd_codon = array_count_values($arraycodon);

            
          // $indices = array_keys($codons_inexistentes);

          // Atribuir zero nos codons inexistentes 
           //for($i=0; $i<sizeof($indices);$i++){
             //   $posicao = $indices[$i];
              //  $qtd_codon[$posicao] = 0;      
          //}

            $x=1;
             foreach($qtd_codon AS $arraycodon => $qtd_vezes) {
                $soma =  $soma + ($qtd_vezes * $qtd_vezes);
                $frequencia[$x] = $qtd_vezes;
                $x++;
           }
 

            $norma = sqrt($soma);
          
           //Calcula frequencia normalizada
          for($j=1; $j <= 64; $j++){
              $array[$j] = ($frequencia[$j]/$norma);
          }

      
          $frenN = implode(',', $array);
           
          return $frenN;

    }



        function calcula_cdi($arrayCodonPrim,$frequencia){


          $soma=0;
          $prod = 0;

           $frequencia_normalizada = array_column($arrayCodonPrim, 'frequencia_normalizada');


            for($i=0; $i<64;$i++){

                $frenCodonPrin=str_replace(",", ".", $frequencia_normalizada[$i]);
                $frenCodonSec=str_replace(",", ".", $frequencia[$i]);
                $prod =  ((double)$frenCodonPrin * (double)$frenCodonSec);
                
                $soma = $soma + $prod;
            }
              
               $cdi_1 = 1-$soma;
               $cdi = $cdi_1*100;

               return $cdi;


       }

}


?>