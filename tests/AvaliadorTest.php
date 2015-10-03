<?php
require_once 'class/Usuario.php';
require_once 'class/Leilao.php';
require_once 'class/Lance.php';
require_once 'class/Avaliador.php';

/**
 * AvaliadorTest
 *
 * @group Avaliador
 */
class AvaliadorTest extends \PHPUnit_Framework_TestCase
{
    private $avaliador;

    public function setUp() {
        $this->avaliador = new Avaliador();
    }

    public function tearDown() {
        var_dump("---------FIM---------");
    }

    public static function setUpBeforeClass() {
        var_dump("Before Class!!!");
    }

    public static function tearDownAfterClass() {
        var_dump("After Class!!!");
    }

	private function modeloTeste(array $valorLances) {
		$leilao = new Leilao('Carro Gol Zero');
		$this->avaliador = new Avaliador();
		$count = 0;
		foreach($valorLances as $valor) {
			$count++;
			$leilao->propoe(new Lance(new Usuario('User' . $count, $count), $valor));
		}

		$this->avaliador->avalia($leilao);

		return $this->avaliador;
	}

    public function testVerificaLancesEmOrdemDecrescente() {

		$this->avaliador = $this->modeloTeste(array(300, 200, 100));

		$this->assertEquals(300, $this->avaliador->getMaiorValor(), 'Erro ao verificar maior valor');
		$this->assertEquals(100, $this->avaliador->getMenorValor(), 'Erro ao verificar menor valor');
    }

    public function testVerificaLancesEmOrdemCrescente() {

		$this->avaliador = $this->modeloTeste(array(100, 200, 300));

		$this->assertEquals(300, $this->avaliador->getMaiorValor(), 'Erro ao verificar maior valor');
		$this->assertEquals(100, $this->avaliador->getMenorValor(), 'Erro ao verificar menor valor');
    }

    public function testVerificaMediaLances() {
    	$this->avaliador = $this->modeloTeste(array(100, 200, 300));
		$this->assertEquals(200, $this->avaliador->getMediaLances(), 'Erro no calculo de medias dos lances');
    }

    public function testVerificaSucessoApenasUmLance() {
    	$this->avaliador = $this->modeloTeste(array(100));
    	$this->assertEquals(100, $this->avaliador->getMaiorValor(), 'Erro ao verificar maior valor');
		$this->assertEquals(100, $this->avaliador->getMenorValor(), 'Erro ao verificar menor valor');
		$this->assertEquals(1, $this->avaliador->getQtdLances(), 'Não foi encontrado a quantidade de lances correta');
    }

    public function testVerificaLacesAleatorios() {
    	$this->avaliador = $this->modeloTeste(array(200, 450, 120, 700, 630, 230));
    	$this->assertEquals(700, $this->avaliador->getMaiorValor(), 'Erro ao verificar maior valor');
		$this->assertEquals(120, $this->avaliador->getMenorValor(), 'Erro ao verificar menor valor');
		$this->assertEquals(6, $this->avaliador->getQtdLances(), 'Não foi encontrado a quantidade de lances correta');
    }

    public function testVerificaTresMaiores() {
    	$this->avaliador = $this->modeloTeste(array(200, 450, 120, 700, 630));
    	$this->assertEquals(3, count($this->avaliador->getTresMaiores()), 'Erro ao verificar os 3 maiores lances');
    	foreach($this->avaliador->getTresMaiores() as $maiores)
    		$arrayMaiores[] = $maiores->getValor();
		$this->assertEquals(array(700, 630, 450), $arrayMaiores, 'Erro ao verificar valores dos 3 maiores lances');
    }

    public function testVerificaTresMaioresComDoisLances() {
    	$this->avaliador = $this->modeloTeste(array(200, 450));
    	$this->assertEquals(2, count($this->avaliador->getTresMaiores()), 'Erro ao verificar os 3 maiores lances');
    	foreach($this->avaliador->getTresMaiores() as $maiores)
    		$arrayMaiores[] = $maiores->getValor();
		$this->assertEquals(array(450, 200), $arrayMaiores, 'Erro ao verificar valores dos 3 maiores lances');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testVerificaTresMaioresComNenhumLanceDado() {
    	$this->avaliador = $this->modeloTeste(array());
    	$this->assertEquals(0, count($this->avaliador->getTresMaiores()), 'Erro ao verificar os 3 maiores lances');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testLancaExcessaoAoAvaliar()
    {
        $leilao = new Leilao("Carro Ford");
        $this->avaliador->avalia($leilao);
    }
}
