<?php	
	
session_start();

$lista = $_SESSION['resultado'];

	$html = '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>ID</th>';
	$html .= '<th>Espécie</th>';
	$html .= '<th>Gene</th>';
	$html .= '<th>Subtipo</th>';
	$html .= '<th>Trecho Sequencia</th>';
	$html .= '<th>Ano</th>';
	$html .= '<th>Pais</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
	//$result_transacoes = "SELECT * FROM transacoes";
	//$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
	foreach ($lista as $value): 
		$html .= '<tr><td>'.$value['id_resultado'] . "</td>";
		$html .= '<td>'.$value['especie'] . "</td>";
		$html .= '<td>'.$value['gene'] . "</td>";
		$html .= '<td>'.$value['subtipo'] . "</td>";
		$html .= '<td>'.$value['trechoSelecionado'] . "</td>";
		$html .= '<td>'.$value['ano'] . "</td>";
		$html .= '<td>'.$value['pais'] . "</td></tr>";		
	endforeach; 
	
	$html .= '</tbody>';
	$html .= '</table';

	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega seu HTML
	$dompdf->load_html('
			<h1 style="text-align: center;">Celke - Relatório de Transações</h1>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"relatorio.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>