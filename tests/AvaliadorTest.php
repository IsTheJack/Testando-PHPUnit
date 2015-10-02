<?php
require 'class/Usuario.php';
require 'class/Leilao.php';
require 'class/Lance.php';
require 'class/Avaliador.php';

/**
 * AvaliadorTest
 *
 * @group Avaliador
 */
class AvaliadorTest extends \PHPUnit_Framework_TestCase
{
	private function modeloTeste(array $valorLances) {
		$leilao = new Leilao('Carro Gol Zero');
		$avaliador = new Avaliador();
		$count = 0;
		foreach($valorLances as $valor) {
			$count++;
			$leilao->propoe(new Lance(new Usuario('User' . $count, $count), $valor));
		}

		$avaliador->avalia($leilao);

		return $avaliador;
	}

    public function testVerificaLancesEmOrdemDecrescente() {

		$avaliador = $this->modeloTeste(array(300, 200, 100));

		$this->assertEquals(300, $avaliador->getMaiorValor(), 'Erro ao verificar maior valor');
		$this->assertEquals(100, $avaliador->getMenorValor(), 'Erro ao verificar menor valor');
    }

    public function testVerificaLancesEmOrdemCrescente() {

		$avaliador = $this->modeloTeste(array(100, 200, 300));

		$this->assertEquals(300, $avaliador->getMaiorValor(), 'Erro ao verificar maior valor');
		$this->assertEquals(100, $avaliador->getMenorValor(), 'Erro ao verificar menor valor');
    }

    public function testVerificaMediaLances() {
    	$avaliador = $this->modeloTeste(array(100, 200, 300));
		$this->assertEquals(200, $avaliador->getMediaLances(), 'Erro no calculo de medias dos lances');
    }

    public function testVerificaSucessoApenasUmLance() {
    	$avaliador = $this->modeloTeste(array(100));
    	$this->assertEquals(100, $avaliador->getMaiorValor(), 'Erro ao verificar maior valor');
		$this->assertEquals(100, $avaliador->getMenorValor(), 'Erro ao verificar menor valor');
		$this->assertEquals(1, $avaliador->getQtdLances(), 'Não foi encontrado a quantidade de lances correta');
    }

    public function testVerificaLacesAleatorios() {
    	$avaliador = $this->modeloTeste(array(200, 450, 120, 700, 630, 230));
    	$this->assertEquals(700, $avaliador->getMaiorValor(), 'Erro ao verificar maior valor');
		$this->assertEquals(120, $avaliador->getMenorValor(), 'Erro ao verificar menor valor');
		$this->assertEquals(6, $avaliador->getQtdLances(), 'Não foi encontrado a quantidade de lances correta');
    }

    public function testVerificaTresMaiores() {
    	$avaliador = $this->modeloTeste(array(200, 450, 120, 700, 630));
    	$this->assertEquals(3, count($avaliador->getTresMaiores()), 'Erro ao verificar os 3 maiores lances');
    	foreach($avaliador->getTresMaiores() as $maiores)
    		$arrayMaiores[] = $maiores->getValor();
		$this->assertEquals(array(700, 630, 450), $arrayMaiores, 'Erro ao verificar valores dos 3 maiores lances');
    }

    public function testVerificaTresMaioresComDoisLances() {
    	$avaliador = $this->modeloTeste(array(200, 450));
    	$this->assertEquals(2, count($avaliador->getTresMaiores()), 'Erro ao verificar os 3 maiores lances');
    	foreach($avaliador->getTresMaiores() as $maiores)
    		$arrayMaiores[] = $maiores->getValor();
		$this->assertEquals(array(450, 200), $arrayMaiores, 'Erro ao verificar valores dos 3 maiores lances');
    }

    public function testVerificaTresMaioresComNenhumLanceDado() {
    	$avaliador = $this->modeloTeste(array());
    	$this->assertEquals(0, count($avaliador->getTresMaiores()), 'Erro ao verificar os 3 maiores lances');
    }
}
