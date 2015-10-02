<?php
class Avaliador
{
	private $maiorValor = - 1;
	private $menorValor = INF;
	private $mediaLances = 0;
	private $somaLances = 0;
	private $qtdLances = 0;
	private $maiores;

	public function avalia(Leilao $leilao) {
		foreach ($leilao->getLances() as $lance) {
			$this->somaLances += $lance->getValor();
			$this->maiorValor = $lance->getValor() > $this->maiorValor? $lance->getValor(): $this->maiorValor;
			$this->menorValor = $lance->getValor() < $this->menorValor? $lance->getValor(): $this->menorValor;
		}
		$this->qtdLances = count($leilao->getLances());
		if($this->qtdLances > 0)
			$this->mediaLances = $this->somaLances / $this->qtdLances;
		$this->pegaOsMaioresNo($leilao);
	}

	public function pegaOsMaioresNo(Leilao $leilao) {

            $lances = $leilao->getLances();
            usort($lances,function ($a,$b) {
                if($a->getValor() == $b->getValor()) return 0;
                return ($a->getValor() < $b->getValor()) ? 1 : -1;
            });

            $this->maiores = array_slice($lances, 0,3);
        }

    public function getTresMaiores() {
        return $this->maiores;
    }

	public function getMaiorValor() {
		return $this->maiorValor;
	}

	public function getMenorValor() {
		return $this->menorValor;
	}

	public function getMediaLances() {
		return $this->mediaLances;
	}

	public function getQtdLances()
	{
		return $this->qtdLances;
	}
}