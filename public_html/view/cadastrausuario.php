<?php 
include 'header.html';
?>

<div class="fieldset" style="width: 100%; height: 400px;">

       <!--   <script src="//ajax.googleapis.com/ajax/libs/JQuery/1.9.1/JQuery.min.js"></script> -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!--      <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.12.0/validate.min.js"></script>
 -->     <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>

<!-- start form for validation -->
<!-- <form method="post" action= "../controller/sequenciaController.php" id="formulario" style="border: 50px;" data-parsley-validate> -->

 <fieldset id="query" style="width: 500px; height: 370px;"> </br></br>

     <!-- <fieldset class="pesquisa" id="virus"> -->
         <strong><legend>Please enter your details:</legend></strong>
           <fieldset class="pesquisa parte1" style="">


		    <form class="login-form" method="post" action="../controller/loginController.php" >
		      <div class="login"> Username: </div>
		      <input type="text" name="login" />
		      <div class="login"> Password: </div>
		      <input type="password"  name="senha" />
		      <input type="hidden" name="perfil" value="2" />
		      <input type="hidden" name="acao" value="cad" />
		      </br></br>

		      <button style="left: 50%">Submit</button>
		      
		    </form>
           
         <!-- </fieldset>-->
         </fieldset>

       <!--  </fieldset> -->

</fieldset>
</div>


<?php
include 'footer.html';
?>
