<?php

require_once("conexao.php");
require_once("view/pesquisa.php");

class PesquisaDao{
	
	  	public function __construct(){
			$this->con = new Conexao();
			$this->pdo = $this->con->conectar();
        }
		
		
		
		

		public function cadastrar(Contato $contato) {
				
				try {
					$stmt = $this->pdo->prepare('INSERT INTO contatos (nome, email, celular) VALUES (:nome, :email, :celular)'
					);
					
					$param = array(
						':nome'=> $contato->getNome(),
						':email'=> $contato->getEmail(),
						':celular'=> $contato->getCelular()
						
					);
					
					return $stmt->execute($param);
				
				}catch(PDOException $e) {
					echo "Erro: {$e->getMessage()}";
				}
		}
		
		
			public function cadastrar(Contato $contato) {
				
				try {
					$stmt = $this->pdo->prepare('SELECT nome, usuario FROM login');
					
					$param = array(
						':nome'=> $contato->getNome(),
						':email'=> $contato->getEmail(),
						':celular'=> $contato->getCelular()
						
					);
					echo $_REQUEST["act"];
					
					return $stmt->execute($param);
				
				}catch(PDOException $e) {
					echo "Erro: {$e->getMessage()}";
				}
		}


}

?>

 public function selectDB($sql,$params=null,$class=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);


<?php
$consulta = $pdo->query("SELECT nome, usuario FROM login;");
 
  
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    echo "Nome: {$linha['nome']} - Usuário: {$linha['usuario']}<br />";
}
?>