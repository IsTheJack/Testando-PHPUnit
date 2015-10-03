<?php
class Leilao
{
	private $descricao;
	private $lances;
	private $limiteLances = 5;
	
	public function __construct($descricao) {
		$this->descricao = $descricao;
		$this->lances = array();
	}
	
	public function propoe(Lance $lance) {
		if ($lance->getValor() < 0)
			throw new InvalidArgumentException('O valor de um lance de um leilão não pode ser negativo');
		
		if(!$this->lances || ($this->getUltimoUsuario() !== $lance->getUsuario() && $this->verificaLimite($lance)))
			$this->lances[] = $lance;
	}

	public function getUltimoUsuario() {
		return $this->getLances()[count($this->getLances()) - 1]->getUsuario();
	}

	private function verificaLimite(Lance $lance) {
		$resultado = array_filter($this->getLances(), function($item) use ($lance) {
			return $item->getUsuario() === $lance->getUsuario();
		});
		array_push($resultado, $lance);

		if(count($resultado) <= $this->limiteLances)
			return true;
		return false;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function getLances() {
		return $this->lances;
	}

	public function getUltimoLanceUsuario(Usuario $usuario)
	{
		$resultado = array_filter($this->getLances(), function($item) use ($usuario) {
			return $item->getUsuario() === $usuario;
		});

		if ($resultado)
			return $resultado[count($resultado) - 1]->getValor();
		return false;
	}

	public function dobraLance(Usuario $usuario)
	{
		if ($this->getUltimoLanceUsuario($usuario))
			$this->propoe(new Lance($usuario, $this->getUltimoLanceUsuario($usuario) * 2));
	}
}