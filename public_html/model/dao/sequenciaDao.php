<?php

require_once("conexao.php");

class SequenciaDao{
    
        public function __construct(){
            $this->con = new Conexao();
            $this->pdo = $this->con->conectar();
        }

        
        public function insere(Sequencia $seq) {

                
            try {
                    $stmt = $this->pdo->prepare('INSERT INTO sequencia (accession, id_especie,tamanho, sequencia, sequencia_numero, subtipo, id_gene, ano, pais) 
                                                        VALUES (:accession,:especie_id, :tamanho, :sequencia, :sequencia_numero, :subtipo, :gene_id, :ano, :pais)');
                    
                    $param = array(
                        ':accession'=> $seq->getAccession(),
                        ':id_especie'=> $seq->getEspecie_id(),
                        ':tamanho'=> $seq->getTamanho(),
                        ':sequencia'=> $seq->getSequencia(),
                        ':sequencia_numero'=> $seq->getSequenciaCompactada(),
                        ':subtipo'=> $seq->getSubtipo(),
                        ':id_gene'=> $seq->getGene_id(),
                        ':ano'=> $seq->getAno(),
                        ':pais'=> $seq->getPais()                 

                    );
                    
                    return $stmt->execute($param);
                
                }catch(PDOException $e) {
                    echo "Erro: {$e->getMessage()}";
                }
        }



        public function lista($seq, $datainicial, $datafinal,$id_continente) {    

            try {

               $sql = ' select s.sequencia, s.id_especie, e.tipo_especie, s.id_pais,  s.subtipo, g.tipo_gene, s.ano,  s.sequencia_numero, s.tamanho,p.id_continente, p.desc_pais, c.desc_continente, s.accession 
                                             from sequencia  s 
                                             inner join especie e on e.id_especie = s.id_especie
                                             inner join gene g on g.id_gene = s.id_gene
                                             inner join pais p on p.id_pais = s.id_pais 
                                             inner join continente c on c.id_continente = p.id_continente 
                                             where  s.id_especie in ('.$seq->getEspecie_id().') 
                                             and s.id_gene = '.$seq->getGene_id().' and s.subtipo in ("'.$seq->getSubtipo().'") and  estado = 1 and sequencia_numero <>"" ';
            


               if ($id_continente != 0 || $id_continente != ""){
                   
                    $sql .= 'and  c.id_continente in ('.$id_continente.')'; 

                } if ($datainicial != "" || $datafinal != ""){

                   $sql .= ' and ano between "'.$datainicial.'" and "'.$datafinal.'"';

                }


                    $stmt = $this->pdo->prepare($sql);





               // $stmt = $this->pdo->prepare('select s.sequencia, s.id_especie, e.tipo_especie, s.id_pais,  s.subtipo, g.tipo_gene, s.ano,  s.sequencia_numero, s.tamanho,p.id_continente, p.desc_pais, c.desc_continente 
               //                               from sequencia  s 
               //                               inner join especie e on e.id_especie = s.id_especie
               //                               inner join gene g on g.id_gene = s.id_gene
               //                               inner join pais p on p.id_pais = s.id_pais 
               //                               inner join continente c on c.id_continente = p.id_continente 
               //                               where  s.id_especie in ('.$seq->getEspecie_id().') 
               //                               and s.id_gene = '.$seq->getGene_id().' and s.subtipo in ("'.$seq->getSubtipo().'") 
               //                               and ano between "'.$datainicial.'" and "'.$datafinal.'" 
               //                               and  c.id_continente in ('.$id_continente.') and estado = 1 and sequencia_numero <>"";');


               

         //echo " query: ".$stmt->queryString;
			     //die();


                // depois verificar
                $param = array(
                    'id_especie', $seq->getEspecie_id(),
                    'id_gene', $seq->getGene_id(),
                    'subtipo', $seq->getSubtipo()
                   // ':gene'=> $seq->getGene(),
                );

               // print_r($param);
              
             //  echo "query: ".$stmt->queryString;
                $stmt->execute();
              // echo("===Daiane Rose===");
              // echo "query: ".$stmt->queryString;
               // exit();
             return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
            
            }catch(PDOException $e) {
                echo "Erro: {$e->getMessage()}";
            }
        }



        public function insereResul($hostsDesc,$geneDesc,$str_subtipos, $periodo, $tamanhoSeq, $qtd, $continente, $usuario){
                  

            try {


                $continentes = "";
                 
                 if ($continente != ""){


                     $stmtcont = $this->pdo->prepare('SELECT desc_continente FROM continente WHERE id_continente IN('.$continente.')');


                     $stmtcont->execute();
                     $lista_continentes = $stmtcont->fetchAll();
                     $array_cont = array_column($lista_continentes, 'desc_continente');

                     $continentes = implode(', ', $array_cont);
                     //$continentes_id = implode(', ', $continente);

                 }



                    $stmt = $this->pdo->prepare('INSERT INTO resultado_temp (especie, gene, ano, subtipo, tamanho_sequencia, quantidade, continente, id_usuario, id_continente) 
                                                        VALUES (:especie,:gene,:ano,:subtipo, :tam, :qtd, :continente, :usuario,:id_continente)');

  
                    $param = array(
                        ':especie'=> $hostsDesc,
                        ':gene'=> $geneDesc,
                        ':subtipo'=> $str_subtipos,
                        ':ano'=> $periodo,
                        ':tam'=> $tamanhoSeq,
                        ':qtd'=> $qtd,
                        ':continente'=> $continentes,
                        ':usuario'=> $usuario,
                        ':id_continente'=> $continente 
                    );

                    $stmt->execute($param);

                     // echo "query: ".$stmt->queryString;
                     // exit();

                    $id  = $this->pdo->lastInsertId();
                    
                    return $id;
                
                }catch(PDOException $e) {
                    echo "Erro: {$e->getMessage()}";
                }
        }

      


        public function insereResul2($sql){

            try {

             $stmt = $this->pdo->prepare('INSERT INTO resultado_temp2 (id_resultado_temp, trecho, especie, gene, ano, frequencia, subtipo, cdi,regiao,accession,pais) VALUES'.implode(',', $sql) );
                
//echo "query Daiane : ".$stmt->queryString;

 //exit();
               
                   $result = $stmt->execute();

                 
 
                    return $result;
                              
                }catch(PDOException $e) {
                    echo "Erro: {$e->getMessage()}";
                }
        }



        public function listaResul($usuario) {  

         try {
                $stmt = $this->pdo->prepare('select * from resultado_temp where id_usuario = '.$usuario);

                $stmt->execute();

                   //  echo "query: ".$stmt->queryString;

                    // exit();

              return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
            }catch(PDOException $e) {
                echo "Erro: {$e->getMessage()}";
            } 


        }


  public function listaResulTemp($id) {  

   // echo 'dentro dao: '. $id;
    $ids = implode(',', $id);
//echo 'dao: ';
    //print_r($ids);
   // exit();

         try {
                $stmt = $this->pdo->prepare(' SELECT tem2.* , p.desc_pais, c.desc_continente from resultado_temp2 as tem2 
                                           left join pais as p 
                                              on tem2.pais = p.id_pais 
                                           left join continente as c
                                             on p.id_continente = c.id_continente
                                             where tem2.id_resultado_temp  in('.$ids.') order by tem2.ano ASC');

                // echo "query: ".$stmt->queryString;

                // exit();
                
                $stmt->execute();

              return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
            }catch(PDOException $e) {
                echo "Erro: {$e->getMessage()}";
            } 

        }


        public function listaResul2($id) {  

			//$ids = implode(',', $id);
//print_r($ids );

         try {
                $stmt = $this->pdo->prepare("SELECT * from resultado_temp where id_resultado in({$id})");
                
                $stmt->execute();
				
				// echo "query: ".$stmt->queryString;
				//die();

              return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
            }catch(PDOException $e) {
                echo "Erro: {$e->getMessage()}";
            } 

        }


        public function altera($numero,$id) {

          
          set_time_limit(120);

            //echo $hosp->getFrequencia_normalizada();
       
            try {
                    $stmt = $this->pdo->prepare('update sequencia set  sequencia_numero = :seq_numero where id_sequencia = :id and sequencia_numero is null');
                    
                    $param = array(
                        //':numero'=> $hosp->getCodon_numero(),
                        ':seq_numero'=> $numero,
                        ':id'=> $id
                    );
                    
                    return $stmt->execute($param);
                
                }catch(PDOException $e) {
                    echo "Erro: {$e->getMessage()}";
                }
       }


       public function listaSeq() {     

              try {
                  $stmt = $this->pdo->prepare('SELECT * FROM sequencia where estado = 1;');

                  // depois verificar
                  $param = array(
                      
                  );
            
                  $stmt->execute();

                  return $stmt->fetchAll(PDO::FETCH_ASSOC);
         
              }catch(PDOException $e) {
                  echo "Erro: {$e->getMessage()}";
              }
          }


        public function delete($id){

          $ids = implode(',', $id);
             
              try {
                 
                $stmt = $this->pdo->prepare('DELETE FROM resultado_temp WHERE id_resultado in('.$ids.')');
                // echo "query1: ".$stmt->queryString;

              // exit();
               // $stmt = $this->pdo->prepare('DELETE FROM resultado_temp2 WHERE id_resultado_temp in('.$ids.')');
               //  echo "query2: ".$stmt->queryString;
                 //exit();

                // $stmt1->execute();
               return  $stmt->execute();
                  
                //echo $stmt->rowCount(); 
              } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
              }

        }


        public function buscaCDI($cdiMin, $cdiMax, $anoMin, $anoMax, $id){

            try {
               
                $ids = implode(',', $id);

                $cdiMax_1 = $cdiMax+1;

     $stmt = $this->pdo->prepare('SELECT tem2.* , p.desc_pais from resultado_temp2 as tem2 
                     inner join sequencia as seq 
                        on tem2.accession = seq.accession
                     inner join pais as p 
                        on seq.id_pais = p.id_pais
                                          where tem2.cdi between  "'.$cdiMin.'"  and  "'.$cdiMax_1.'" and tem2.ano 
                                          between "'.$anoMin.'" and "'.$anoMax.'" and tem2.id_resultado_temp in ('.$ids.') order by tem2.cdi ASC;
                                          ;');

      //echo "query: ".$stmt->queryString;

                  // exit();
                    
                   
                $stmt->execute();

              return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
                              
                }catch(PDOException $e) {
                    echo "Erro: {$e->getMessage()}";
                }
        }




}

?>