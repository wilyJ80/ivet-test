
<?php
error_reporting(0);
class Utils{
	

function  trecho_sequencia_selecionada($sequencia, $posicaoInicial, $posicaoFinal){
                  
              $trecho = "";
              $array = explode(',', $sequencia);

              $tam = sizeof($array);


              for($i=0;$i<$tam;$i++){
                   if($array[$i]==0){
                       unset($array[$i]);
                    }

                }


         $arrayTratado = implode(',', $array);
         $array2 = explode(',', $arrayTratado);


               $tam1 = sizeof($array2);

               $tamanho=$tam1/3;

               $ci=floor(($posicaoInicial*$tamanho)/100)+1;
               $pi= 3*$ci-3;
               $cf=ceil(($posicaoFinal*$tamanho)/100);
               $pf= 3*$cf-1;  


              // $i= $pi-1;
              for($i = $pi; $i<$pf; $i++){
                   $trecho = $trecho.$array2[$i].',';
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
          for($i=0; $i<=64;$i++){  
               $qtd_codon[$i]=0;      
          }

           for ($j=0;$j<sizeof($arraycodon);$j++) {
              $qtd_codon[$arraycodon[$j]]++;
          }

            for($i=1; $i<=64;$i++){
                $soma =  $soma + ($qtd_codon[$i]*$qtd_codon[$i]);
           }
 
            $norma = sqrt($soma);
          
           //Calcula frequencia normalizada
          for($j=1; $j <= 64; $j++){
              $array[$j] = ($qtd_codon[$j]/$norma);
          }

      
          $frenN = implode(',', $array);
           
          return $frenN;

    }



        function calcula_cdi($arrayCodonPrim,$frequencia){


//           print_r($arrayCodonPrim);

//           echo "</br>";  echo "</p>";

          

//           print_r($frequencia);
// exit();

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