<?php

class Conexao{

    private $usuario;
	private $senha;
	private $banco;
	private $servidor;
	public $pdo;
	
	
	public function conectar(){
		
	   // $this->servidor = "127.0.0.1:3306";
	   // $this->banco = "bio_bd";
	   // $this->usuario = "root";
	   // $this->senha = "";
	   
	   
	   $this->servidor = "db.painel-web.uneb.br";
	   $this->banco = "ivetune_geral";
	   $this->usuario = "ivetune_user";
	   $this->senha = "dB@gfctasi1cfcf";


		
		try {
           $this->pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);


           $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   if(!$this->pdo){
			  echo "Erro na Conexao!"; 
		   }
		   
		   return $this->pdo;
		   
      } catch(PDOException $e) {
           echo 'ERROR: ' . $e->getMessage();
      }
		
	
		
	}
}	
	
?>
