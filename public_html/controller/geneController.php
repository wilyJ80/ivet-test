
<?php

require_once ('../model/dao/geneDao.php');
require_once ('../model/bean/geneBean.php');

class GeneController{


   
	public function insere() {


		     echo $hobbies = $_POST['hobbies'];

            //$descricao = $_POST['descricao'];


            $gene = new Gene();

            $gene->setDescricao($descricao);

            echo $gene->getDescricao();


	}

    
}


	$controller = new GeneController();
    $controller->insere();


?>