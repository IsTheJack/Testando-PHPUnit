<?php
class AnoBissexto
{
	private $ano;
	
	function __construct($ano) {
		$this->ano = $ano;
	}

	public function verificaAnoBissexto() {
		if ($this->ano % 400 == 0 || ($this->ano % 4 == 0 && $this->ano % 100 != 0))
			return true;
		return false;
	}
}