<?php
class Leilao
{
	private $descricao;
	private $lances;
	
	function __construct($descricao) {
		$this->descricao = $descricao;
		$this->lances = array();
	}
	
	public function propoe(Lance $lance) {
		if ($lance->getValor() < 0)
			throw new InvalidArgumentException('O valor de um lance de um leilão não pode ser negativo');
		$this->lances[] = $lance;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function getLances() {
		return $this->lances;
	}
}