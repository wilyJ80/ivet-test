<?php 
@session_start();
include 'header.html';
include 'menu.html';
?>




<form method="post"   style="border: 50px;" data-parsley-validate>
  <!-- <input type="button" id="btnExport" value=" Export Table data into Excel " />
 -->
   
 <!-- <div style=" left: 400px;  ">  --> 
   <a  href="../view/grafico.php"> <p style="width: 35%; " align="right"> < return </p></a> 
 <!--  </div> -->

  
   
<?php

   if((isset($_SESSION['listaCDI'])) and ($_SESSION['listaCDI']>0) ){

          $array = $_SESSION['listaCDI'];
        //print_r($array);

   ?>


       <fieldset id="query">
 <div style="  width: 100%;">  
    <button style="float:right" onclick="Exportar()">Exportar</button>
  </div>

          <!--  <fieldset class="pesquisa" id="virus" > -->
           <strong><legend>Minhas consultas:</legend></strong>
                 <fieldset class="pesquisa parte1"   >

                  <div class="table" id="dvData" style="width:100%; height: 400px; overflow: auto;" >
                    <table  id= "tblExport" width="100%" border="1">
                     <tr>
                       <!--<th bgcolor="#e2e2e2">Id</th>-->
                      
                       <th bgcolor="#e2e2e2">Accession</th>
                       <th bgcolor="#e2e2e2">Year</th>
                       <th bgcolor="#e2e2e2">Continent</th>
                       <th bgcolor="#e2e2e2">Country</th>
                       <th bgcolor="#e2e2e2">Protein</th>
                       <th bgcolor="#e2e2e2">Species</th>
                       <th bgcolor="#e2e2e2">Subtype</th>
                       <th bgcolor="#e2e2e2">CDI</th>
                       </tr>

                        
                   <?php foreach ($array as $key => $item){
                          foreach ($item as  $value){ ?>
                              <tr class="linhas">
                               <td width="10%" height="20%"><?php echo $value['accession']?></td>
                               <td width="10%" height="20%"><?php echo $value['ano']?></td>
                               <td width="10%" height="20%"><?php echo $value['continente']?></td>
                               <td width="10%" height="20%"><?php echo $value['pais']?></td>
                               <td width="10%" height="20%"><?php echo $value['gene']?></td>
                               <td width="10%" height="20%"><?php echo $value['especie']?></td>
                               <td width="10%" height="20%"><?php echo $value['subtipo']?></td>
                               <td width="5%" height="20%"><?php  echo $value['cdi']?></td>
                               </tr>

                    <?php  } 

                  } ?>

            </table></div>               


      </fieldset>

<!--       </fieldset> -->
   <?php } ?>
  </fieldset>
</form>


<script type="text/javascript">



</script>


<p>
<?php
include 'footer.html';
?>
