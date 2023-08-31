<?php

class Hospedeiro{
	
	private $id;
    private $especie;
    private $codon;
    private $codon_numero;
    private $frequencia;
    private $frequencia_normalizada;


    public function __construct(){
	
	}


	
	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
 
    public function getEspecie() {
        return $this->especie;
    }

    public function setEspecie($especie) {
        $this->especie = $especie;
    }

    public function getCodon() {
        return $this->codon;
    }

    public function setCodon($codon) {
        $this->codon = $codon;
    }

    public function getCodon_numero() {
        return $this->codon_numero;
    }

    public function setCodon_numero($codon_numero) {
        $this->codon_numero = $codon_numero;
    }

    public function getFrequencia() {
        return $this->frequencia;
    }

    public function setFrequencia($frequencia) {
        $this->frequencia = $frequencia;
    }

     public function getFrequencia_normalizada() {
        return $this->frequencia_normalizada;
    }

    public function setFrequencia_normalizada($frequencia_normalizada) {
        $this->frequencia_normalizada = $frequencia_normalizada;
    }

   
}

?>