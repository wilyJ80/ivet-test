<?php

class Sequencia{
	
	private $id;
	private $accession;
    private $especie_id;
    private $origin;
    private $tamanho;
    private $subtipo;
    private $sequencia;
    private $gene_id;
    private $ano;
    private $pais;
    private $sequenciaCompactada;
	
	

    public function __construct(){
	
	}


	
	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
 
    public function getAccession() {
        return $this->accession;
    }

    public function setAccession($accession) {
        $this->accession = $accession;
    }

    public function getEspecie_id() {
        return $this->especie_id;
    }

    public function setEspecie_id($especie_id) {
        $this->especie_id = $especie_id;
    }
	
    public function getOrigin() {
        return $this->origin;
    }

    public function setOrigin($origin) {
        $this->origin = $origin;
    }

    public function getTamanho() {
        return $this->tamanho;
    }

    public function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }

    public function getSubtipo() {
        return $this->subtipo;
    }

    public function setSubtipo($subtipo) {
        $this->subtipo = $subtipo;
    }

    public function getLocalizacao_id() {
        return $this->localizacao_id;
    }

    public function setLocalizacao_id($localizacao_id) {
        $this->localizacao_id = $localizacao_id;
    }

    public function getSequencia() {
        return $this->sequencia;
    }
    

    public function setSequencia($sequencia) {
        $this->sequencia = $sequencia;
    }


    public function getGene_id() {
        return $this->gene_id;
    }

    public function setGene_id($gene_id) {
        $this->gene_id = $gene_id;
    }


    public function getAno() {
        return $this->ano;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function getPais() {
        return $this->pais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

        public function getSequenciaCompactada() {
        return $this->sequenciaCompactada;
    }

    public function setSequenciaCompactada($sequenciaCompactada) {
        $this->sequenciaCompactada = $sequenciaCompactada;
    }

}

?>