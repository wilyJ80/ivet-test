<?php 
@session_start();
include 'header.html';
include 'menu.html';



/* esse bloco de código em php verifica se existe a sessão, pois o usuário pode
 simplesmente não fazer o login e digitar na barra de endereço do seu navegador 
o caminho para a página principal do site (sistema), burlando assim a obrigação de 
fazer um login, com isso se ele não estiver feito o login não será criado a session, 
então ao verificar que a session não existe a página redireciona o mesmo
 para a index.php.*/

if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  header('location: ../index.php');
  }
 
$usuario = $_SESSION['usuario'];

//echo"ID usuario: ".  $usuario;

?>

<div class="fieldset">

       <!--   <script src="//ajax.googleapis.com/ajax/libs/JQuery/1.9.1/JQuery.min.js"></script> -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!--      <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.12.0/validate.min.js"></script>
 -->     <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>

<!-- start form for validation -->
<form method="post" action= "../controller/sequenciaController.php" id="formulario" style="border: 50px;" data-parsley-validate>

 <fieldset id="query">
     <fieldset class="pesquisa" id="virus">
     <strong><legend>Set search:</legend></strong>
           <fieldset class="pesquisa parte1">
              <span class="field" id="field_host">
                <label><span><strong>Host Species</strong></span>
                   <select name="host" >

                     <option value="0">select</option>
                        <?php
                         //provisorio 
                          require_once ('../model/dao/especieDao.php');
                          $especieDao = new  EspecieDao();
                          $array = $especieDao->lista();
                              foreach ($array as list($v1, $v2) ){?>
                              <option value="<?php echo $v1; ?>"><?php echo $v2; ?></option>
                         <?php }?>
                    </select>

                  </label>

             </p>

            <label><span><strong>Codon Usage</strong></span>
                   <select name="codonusage" >

                     <option value="0">select</option>
                        <?php
                         //provisorio 
                          require_once ('../model/dao/especieDao.php');
                          $especieDao = new  EspecieDao();
                          $array = $especieDao->lista();
                              foreach ($array as list($v1, $v2) ){?>
                              <option value="<?php echo $v1; ?>"><?php echo $v2; ?></option>
                         <?php }?>
                    </select>
                  </label>
              </span>

              </span>


              <span class="field" id="field_pais">
              <label><span><strong>Continent</strong></span>
                <select name="continente[]" multiple>
                  <!-- <option value="0">TODOS</option> -->
                  <?php
                     //provisorio 
                      require_once ('../model/dao/continenteDao.php');
                      $continente = new  ContinenteDao();
                      $array = $continente->lista();
                      print_r($array);
                  
                  foreach ($array as list($v1, $v2) ){?>
                   <option value="<?php echo $v1; ?>"><?php echo $v2; ?></option>
                   <?php }?>
                </select>
              </label>
              </span>

              <span class="field" id="field_gene">
                <label><span><strong>Protein</strong></span>
                  </br><strong>Ha</strong>
                  <input type="radio"  name="gene" id="gender" value="1" CHECKED /> 
                  <strong>Na</strong>
                  <input type="radio"  name="gene" id="gender" value="2"/>
                </label>
              </span>


              <span class="field" id="field_subtipo">
              <strong>subtype</strong><br>
                 <label id="field_subtipoH"> 
                 <strong>H</strong>
                  <select name="subtipo1" >
                     <?php

                      for($i=1; $i<17; $i++){?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                      <?php }?>
                  </select>
                  </label>
                  
                  <label id="field_subtipoN"> 
                  <strong>N</strong>
                  <select name="subtipo2">
                     <?php

                      for($i=1; $i<10; $i++){?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                      <?php }?>
                  </select>
                </label>
              </span>

         
         <!-- <fieldset class="pesquisa" id="trecho" style="width:250px;">-->
         <span class="field" id="field_trecho">
           <table class="fields">
                <thead><tr><th colspan="2"><label for="flen" id="labels"><strong>Gene Stretch%</strong></label></th></tr></thead>
                <tbody>
                <tr>
                  <th><label for="flen">Home position:</label></th>
                  <td><input type="text" name="trechoinicial" id="flen" size="6" maxlength="6" value=""></td>
                </tr>
                <tr>
                  <th><label for="tlen" >Final position:</label></th>
                  <td><input type="text" name="trechofinal" id="tlen" size="6" maxlength="6" value=""></td>
                </tr>
                </tbody>
           </table>
           </span>

        <!-- </fieldset>-->

       <!-- <fieldset class="pesquisa" id="periodo">-->
           <table class="fields">
                <thead><tr><th colspan="2"><label for="flen" id="labels"><strong>Period</strong></label></th></tr></thead>
                <tbody>
                <tr>
                  <th><label for="flen">First year:</label></th>
                  <td><input type="text" name="datainicial" id="flen" size="6" maxlength="6" value=""></td>
                </tr>
                <tr>
                  <th><label for="tlen">Last year:</label></th>
                  <td><input type="text" name="datafinal" id="tlen" size="6" maxlength="6" value=""></td>
                </tr>
                </tbody>
           </table>
         <!-- </fieldset>-->
         </fieldset>

        </fieldset>


        <div class="buttons">
          
           <input type="hidden" name="acao" value="bus" /><br />
           <input type="submit" value="Add" style="float:right" />
        </div>

</fieldset>
</form>

<p>













<form method="post"  action= "../controller/sequenciaController.php" id="formulario" style="border: 50px;" data-parsley-validate>
<?php

   if((isset($_SESSION['resul'])) and ($_SESSION['resul']>0) ){

       $array =  $_SESSION['resul'];

     //  print_r( $array);
     // exit();

?>

       <fieldset id="query">
           <fieldset class="pesquisa" id="virus" >
           <strong><legend>My queries:</legend></strong>
                 <fieldset class="pesquisa parte1"   >

                  <div class="table" style="width:100%; height: 250px; overflow: auto;" >
                    <table width="100%" border="1">
                     <tr>
                       <!--<th bgcolor="#e2e2e2">Id</th>-->
                       <th bgcolor="#e2e2e2"> <input class="check" name="check[]" type="checkbox" id="checkTodos"> <img src="../images/ex.png" width="22" height="22" id="excluir"></th>
                       <th bgcolor="#e2e2e2">Id</th>
                       <th bgcolor="#e2e2e2">Species</th>
                       <th bgcolor="#e2e2e2">Continent</th>
                       <th bgcolor="#e2e2e2">Gene</th>
                       <th bgcolor="#e2e2e2">Subtype</th>
                        <th bgcolor="#e2e2e2">Period</th>
                        <th bgcolor="#e2e2e2">Sequence Number</th>
                        <th bgcolor="#e2e2e2">Sequence Size</th>
                      
                       </tr>

                        
               <?php foreach ($array as $value){  ?>

                <tr class="linhas">
                   <td width="10%" height="20%"> <input class="check" name="check[]" type="checkbox" value="<?php echo $value['id_resultado']?>"></td>
                   <td width="10%" height="20%"><?php echo $value['id_resultado']?></td>
                   <td width="10%" height="20%"><?php echo $value['especie']?></td>
                   <td width="10%" height="20%"><?php echo $value['continente']?></td>
                   <td width="5%" height="20%"><?php  echo $value['gene']?></td>
                   <td width="10%" height="20%"><?php echo $value['subtipo']?></td>
                   <td width="10%" height="20%"><?php echo $value['ano']?> </td>
                   <td width="10%" height="20%"><?php echo $value['quantidade']?></td>
                   <td width="10%" height="20%"><?php echo $value['tamanho_sequencia']?></td>
                 </tr>

             <?php  }   ?>

                     </table>
                   </div>
                </fieldset>
                </fieldset>
                 </br>          


 <div style="float:left; width: 380px; height: 200px ;  border:solid 1px;
    border-radius:7px; border-color: #724128; ">
 <!--  <form method="post" action="grafico.php"  data-parsley-validate> -->
   <strong><legend>Graphic Setting:</legend></strong>

           
         <div style="float: left; width: 50%;">
         <span class="field" id="field_trecho" style="float:left;" >
           <table class="fields">
                <tbody>
                <tr>
                  <th><label for="tlen"><strong>Symbol size:</strong></label></th>
                  <td><input type="text" name="simbolo" id="flen" size="4" maxlength="4" value=""></td>
                </tr>
                </tbody>
           </table>
           <p><p>
            <span class="field" id="field_pais">
            <label><span><strong>Color:</strong></span>
                 <select name="cores[]" multiple>
                     <option value="0">Select</option>
                     <option value="#0000FF">blue</option>
                     <option value="#FF00FF">margenta</option>
                     <option value="#FF0000">red</option>
                     <option value="#00FF00">green</option>  
                </select>
              </label>
            </span>
           </span>
         </div>

         <div style="float: left; width: 50%;">
            <span class="field" id="field_trecho" style="float:right;">
           <table class="fields">
              
                <tbody>
                <tr>
                  <!-- <thead><tr><th colspan="2"><label for="flen" id="labels"><strong>First year</strong></label></th></tr></thead> -->
                   <th><label for="tlen"><strong>First year:</strong></label></th>
                  <td><input type="text" name="anoinicial" id="flen" size="6" maxlength="6" value=""></td>
                </tr>
                <tr>
                   <th><label for="tlen"><strong>Last year:</strong></label></th>
                  <td><input type="text" name="anofinal" id="tlen" size="6" maxlength="6" value=""></td>
                </tr>
                </tbody>
           </table>

           <p><p>

           <span class="field" id="field_trecho">
           <table class="fields">
              
                <tbody>
                <tr>
                  <th><label for="tlen"><strong>Min CDI:</strong></label></th>
                  <td><input type="text" name="cdiinicial" id="flen" size="6" maxlength="6" value=""></td>
                </tr>
                <tr>
                  <th><label for="tlen"><strong>Max CDI:</strong></label></th>
                  <td><input type="text" name="cdifinal" id="tlen" size="6" maxlength="6" value=""></td>
                </tr>
                </tbody>
           </table>
           </span>
           </span>
          </div> 
<!--    </form> -->
 </div>


   <div style="float:right; padding-top: 180px;">

     <button name="acao"  value="graf">Graphic</button>
    <!--  <input type="button" value="Relatório"  onclick="javascript: window.open('./gerapdf.php');" /> -->
     <button class="excluird"  name="acao"  value="exc" >Delete</button>
   </div>




   <?php } ?>
</fieldset>
</form>



<!-- end form for validations -->

<script type="text/javascript">

    $("#checkTodos").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
    });

   //function confirma_exclusao(){
    $(".excluird").click(function(){
       return confirm('Deseja realmente excluir os registros!?');
    });
   //}



                            
  $("#formulario").validate({
    rules: {
    'host': {
      required: true

    },
     'codonusage': {
      required: true

    },
    'trechoinicial':{
      required:true
    },
    'trechofinal':{
      required:true
    }                      
    },
    messages: {
    host:{
      required:"Por favor, informe a espécie"
    },
     codonusage:{
      required:"Por favor, informe o codon usage"
    },
    trechoinicial:{
      required:"É necessário informar o trecho inicial"
    },
    trechofinal:{
      required:"É necessário informar o trecho final"
    }     
    }
  });

</script>


</div> 
<p>


<?php
include 'footer.html';
?>


 





