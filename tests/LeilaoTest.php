<?php
require_once 'class/Usuario.php';
require_once 'class/Leilao.php';
require_once 'class/Lance.php';
require_once 'class/Avaliador.php';

/**
 * LeilaoTest
 *
 */
class LeilaoTest extends \PHPUnit_Framework_TestCase
{
    public function testNaoDeveAceitarDoisLancesSeguidosDoMesmoUsuario() {
    	$leilao = new Leilao("Gol 4 portas");
    	$usuario1 = new Usuario('User1');

    	$leilao->propoe(new Lance($usuario1, 2000));
    	$leilao->propoe(new Lance($usuario1, 3000));

    	$this->assertEquals(1, count($leilao->getLances()), 'O segundo lance nao foi ignorado');
    }

    public function testNaoDeveAceitarMaisQueCincoLancesDoMesmoUsuario()
    {
    	$leilao = new Leilao("Gol 4 portas");

    	$usuario1 = new Usuario('User1');
    	$usuario2 = new Usuario('User2');

    	for ($i = 1; $i < 11; $i++) {
    		$usuario = $i % 2 == 0? $usuario2: $usuario1;
    		$leilao->propoe(new Lance($usuario, 1000 * $i));
    	}

    	$this->assertEquals(10000, $leilao->getLances()[count($leilao->getLances()) - 1]->getValor(), 'O ultimo valor nao bate');
    	$this->assertEquals(10, count($leilao->getLances()), 'O decimo primeiro lance nao foi ignorado');
    }

    public function testDobrandoUmLance() {
    	$leilao = new Leilao("Gol 4 portas");

    	$usuario1 = new Usuario('User1');
    	$usuario2 = new Usuario('User2');

    	$leilao->propoe(new Lance($usuario1, 1500));
    	$leilao->propoe(new Lance($usuario2, 2000));

    	$leilao->dobraLance($usuario1);
    	$avaliador = new Avaliador();
    	$avaliador->avalia($leilao);

    	$this->assertEquals(3000, $avaliador->getMaiorValor(), 'Erro ao dobrar valor de um lance valido');
    }

     public function testNaoDobrarUmLanceSemLanceAnterior() {
    	$leilao = new Leilao("Gol 4 portas");

    	$usuario1 = new Usuario('User1');
    	$usuario2 = new Usuario('User2');

    	$leilao->propoe(new Lance($usuario1, 1500));

    	$leilao->dobraLance($usuario2);
    	$avaliador = new Avaliador();
    	$avaliador->avalia($leilao);

    	$this->assertEquals(1500, $avaliador->getMaiorValor(), 'Erro ao dobrar valor de um lance de um usuario que nao ofereceu lances anteriores');
    }
}
