<?php 
@session_start();
include 'header.html';
include 'menu.html';
?>



 <fieldset id="query"  style=" height: 400px";>
  <strong><legend>Admin Services:</legend></strong>

    <div class="btn-group" role="group" aria-label="Exemplo básico" style="width:45%;
        background:#ad9a7a;
        margin:0 auto;
        padding:20px; ">
        <button type="button" class="btn btn-secondary">Popular Database</button>
        <button type="button" class="btn btn-secondary">Compress sequences</button>
        <button type="button" class="btn btn-secondary">Register Administrator</button>
    </div>

 </fieldset>


<?php
include 'footer.html';
?>


 





