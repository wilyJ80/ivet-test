<?php
ini_set( 'display_errors', 0 );
session_start();
include 'header.html';
include 'menu.html';

$resulCDI = $_SESSION['resulCDI'];

//print_r($resulCDI);


$lista = $_SESSION['resultado'];

$cores= $_SESSION['cores'];

   $coresg = "";

    if($cores[0]=="#"){
    	$coresg = $cores;
    }else{
    	$coresg = substr($cores, 1, -1);
    }

$symbol = 6; $anoinicial = '1910'; $anofinal = '2020';

if($_SESSION['simbolo'] <> ""){
	
   $symbol = $_SESSION['simbolo']; 
}else{
	$symbol = 6;  
}


if($_SESSION['anoinicial'] <> ""){
	
    $anoinicial = $_SESSION['anoinicial']; 
}else{
	
	$anoinicial  = '1910';  
}

if($_SESSION['anofinal'] <> ""){
	
    $anofinal = $_SESSION['anofinal']; 
}else{
	
	$anofinal  = '2020';  
}


if($_SESSION['cdiinicial'] <> ""){
	
    $cdiinicial = $_SESSION['cdiinicial']; 
}else{
	
	$cdiinicial  = '11.53';  
}

if($_SESSION['cdifinal'] <> ""){
	
    $cdifinal = $_SESSION['cdifinal']; 
}else{
	
	$cdifinal  = '35.00';  
}


   
//print_r($lista);



//Divide  o vetor de acordo com o id
$ids = array_flip(array_column($lista, 'id_resultado_temp'));

//echo '<br>';



$novo = array();

foreach($lista as $item){
    if(isset($ids[$item['id_resultado_temp']])){
        $novo[$item['id_resultado_temp']][] = array(
			'ano' => $item['ano'],
			'cdi' => $item['cdi'],
			'subtipo' => $item['subtipo'],
			'accession' => $item['accession'],
			'continente' => $item['desc_continente'],
			'especie' => $item['especie'],
			'gene' => $item['gene'],
			'pais' => $item['desc_pais']
		);
    }
}

$_SESSION['listaCDI']=$novo;  

$array = array_column($lista, 'id_resultado_temp');
$array_ids = array_unique ($array);
$_SESSION['$array_ids']=$array_ids;  
// print_r($array_ids);

 $array_ano = array_column($lista, 'ano');
 $ano_min = min($array_ano);
 $ano_max = max($array_ano);

//echo $item['subtipo'];


$array_cdi = array_column($lista, 'cdi');
 $valor_minimo = min($array_cdi);
 $valor_maximo = max($array_cdi);

 $min = $valor_minimo;
 $max = $valor_maximo;

  // echo $valor_minimo = min($array_cdi)*0.95;
  // echo $valor_maximo = max($array_cdi)*1.05;


//HA - MIN	11.53*0.9	MAX 35.00*1.1
//NA - 	MIN 16.61*0.9	MAX 40.87*1.1

   
   $valor_minimo = $cdiinicial*0.9;
   $valor_maximo = $cdifinal*1.1;

   
 //     echo '<pre>';
	//  var_dump($novo);
	// echo '<\pre>';

	// die('2');
?>


<!DOCTYPE html>
<html>
<head>

<script type="text/javascript">


window.onload = function () {


 // CanvasJS.addColorSet("greenShades", 
 //                ["#0000FF", "#FF00FF", "#FF0000","#00FF00"]);

  CanvasJS.addColorSet("greenShades", 
                 ["<?php echo $coresg; ?>"]);


var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	colorSet: "greenShades",
	
	title:{
		text: "g: <?php echo $item['gene']." | h: ". $item['especie']." | p: ". $item['regiao']; ?>",
		fontSize: 12,
		fontFamily: 'verdana'

	},
	axisX: {
		minimum: "<?php echo $anoinicial ?>",
		maximum: "<?php echo $anofinal ?>",
		interval: 10,
		gridDashType: "dot",
		gridThickness: 2,
		title:"ANO",
		valueFormatString: "0000"
		
	},
	axisY:{        
		title: "CDI",
		minimum: "<?php echo $valor_minimo ?>",
		maximum: "<?php echo $valor_maximo ?>",
		interval: 2,
		suffix: "%"
	},


data: [
		<?php foreach($novo as $key => $item) {  ?>


			{
				type: "scatter",
			    name: "<?php echo $item[0]['subtipo'];?>",
				toolTipContent: "<span style=\"color:#4F81BC \"><b>{name}</span></br><b> Ano:</b> {x} </br><b> CDI:</b></span> {y}",
			    showInLegend: true,
				markerType: "triangle",
				markerSize:"<?php echo $symbol ?>",
				dataPoints: [
					<?php foreach($item as $i) { ?>
						{
							x: <?php echo $i['ano']?>, 
							y: <?php echo $i['cdi']?> 
						},
					<?php } ?>
				]
			},
		<?php } ?>
		]
	});


chart.render();

}


     $(document).ready(function() {

                     $("#form").submit(function(ev){
                      ev.preventDefault();
                       dados = $(this).serialize();

                       //alert(dados);

	                    var cdiMin = $('input[name="cdiMin"]').val();
		 	            var cdiMax = $('input[name="cdiMax"]').val();
			            var anoMin = $('input[name="anoMin"]').val();
			            var anoMax = $('input[name="anoMax"]').val();
			           
						$.ajax({
							url: '../controller/sequenciaController.php',
				            type: 'post',
				            dataType: 'html',
				            data:dados,
				            success: function(data){ 

					               var obj = JSON.parse(data);
	                                
	                               if(obj.length > 0){


				                    var alturaTela= $(document).height();
				                    var larguraTela= $(window).width();

				                    $('#mascara').css({'width':larguraTela,'height':alturaTela});
				                    $('#mascara').fadeIn(1000); 
				                    $('#mascara').fadeTo("slow",0.8);

	                               	$("#janela").show();

				                      for(var i=0;obj.length>i;i++){
											//Adicionando registros retornados na tabela
											$('.tblExport').append('<tr><td>'+obj[i].accession+'</td><td>'+obj[i].ano+'</td><td>'+obj[i].desc_pais+'</td><td>'+obj[i].cdi+'</td></tr>');
							          }

	                               }else{


	                                   alert('There are no CDIs in this range');
	                                 
	                               }


                            }
				            
						});
                  });


                  $("#mascara").click(function(e) {
                      e.preventDefault();
                      $(this).fadeOut("slow");
                      $('.window').fadeOut("slow");
                      $(".tblExport tbody").remove();  

   
                      //window.location.reload();
                  });

                   $(".fechar").click(function(e) {
                       e.preventDefault();
                       $('#mascara').fadeOut(1000,"linear");
                       $('.window').fadeOut(1000,"linear");
                       $(".tblExport tbody").remove();                       
                  });

                   $("#botaoexp").click(function(e) {
                       e.preventDefault();
                                            
                  });
            });  



		$(function() {

		  $(".btn-toggle").click(function(e) {
		    e.preventDefault();
		    el = $(this).data('element');
		    $(el).toggle();
		  });
			
		});

</script>


 <style>
	.center{
	    position: relative;
		left: 32%;
		right: 25%;
		margin-top: 2%
	}

.window{

display: none;
width: 600px;
height: 500px;
position: absolute;
background: #FFFFFF;
left: 25%;
top: 0;
z-index: 9900;
padding:10px;
border-radius: 10px;
}

#mascara{

display: none;
position: absolute;
background: #000;
left: 0;
top: 0;
z-index: 9000;
}

.fechar{

display: block;
text-align: right;

}
  
</style>



</head>
<body>
   <div style="margin-left:30%; width: 50px;  margin-top: 1%;"><a  href="../view/pesquisa.php">< return</a></div>

   <div id="chartContainer" style="height: 400px; width: 32%; " class="center" >

       <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

   </div>

  <div class="center">
    <button type="button" class="btn-toggle" data-element="#minhaDiv">Pick Region</button>
	<!-- <button  id="" >Find Strain</button> -->
	<button  id="" ><a  href="../view/tabela.php">ALL CDIs</a></button>
  </div>


 <form method="post" action="" id="form" class="center">
 	<div id="minhaDiv" style="display:none" >
 	
 		CDI min: <input type="text" id="campo" name="cdiMin" value="" > 
 		<br/><br/>
 		CDI max: <input type="text" id="campo" name="cdiMax" value="" >
 		<br/><br/>
 		Yaer min: <input type="text" id="campo" name="anoMin" value="" >
 		<br/><br/>
 		Yaer max: <input type="text" id="campo" name="anoMax" value="" >
 		<br/><br/>
		<input type="hidden" name="acao" value="busCDI" /><br />

		<button  class="#janela" id="btn_CDI" >CDI Table</button>
		<button  type="reset" >Clear</button>
		

		<!-- <a href="#janela" rel="modal">CDI Table</a> -->
	</div>
 </form>



<div id="dvData1" style="display:none"></div>
 
<div class="window" id="janela" style="top: 250px;">
<a href="#" class="fechar">X Fechar</a>

      <form method="post"  action= "../controller/sequenciaController.php" id="formulario" style="border: 50px;" data-parsley-validate>
		
		  <button id="botaoexp" onclick="Exportar()">Exportar</button>

		              <div class="table" id="dvData" style="width:600px; height: 400px; overflow: auto;" >
		                    <table class="tblExport" id= "tblExport" width="100%" border="1">

                            <thead> 
		                     <tr>
		                       <th bgcolor="#e2e2e2">Accession</th>
		                       <th bgcolor="#e2e2e2">Year</th>
		                       <th bgcolor="#e2e2e2">Country</th>
		                       <th bgcolor="#e2e2e2">CDI</th>
		                     </tr>
                            </thead> 

		                     <tbody>

                             </tbody>
		                     
		                  </table> 
		            </div>            
	
		</form>

<script type="text/javascript">





</script> 
		
</div>

<div id="mascara"></div>

</body>
</html>

<?php
include 'footer.html';
?>





