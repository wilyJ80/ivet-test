<?php

class Gene{
	
	private $id;
	private $decricao;
	
	

    public function __construct(){
	
	}


	
	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
 
    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
	
}

?>