<?php
require 'class/MatematicaMaluca.php';

/**
 * MatematicaMalucaTest
 *
 * @group Alura
 */
class MatematicaMalucaTest extends \PHPUnit_Framework_TestCase
{
    public function testNumeroMaiorQueTrinta() {
    	$m = new MatematicaMaluca();
    	$resultado = $m->contaMaluca(31);
    	$this->assertEquals(31 * 4, $resultado, 'Houve um erro na conta para numeros maiores que 31');
    }

    public function testNumeroMaiorQueDez() {
    	$m = new MatematicaMaluca();
    	$resultado = $m->contaMaluca(11);
    	$this->assertEquals(11 * 3, $resultado, 'Houve um erro na conta para numeros maiores que 11');
    }

    public function testNumeroIgualOuMenoQueDez() {
    	$m = new MatematicaMaluca();
    	$resultado = $m->contaMaluca(9);
    	$this->assertEquals(9 * 2, $resultado, 'Houve um erro na conta para numeros menores que 11');
    }

    public function testNumeroTrinta() {
    	$m = new MatematicaMaluca();
    	$resultado = $m->contaMaluca(30);
    	$this->assertEquals(30 * 3, $resultado, 'Houve um erro na conta para numero 30');
    }

    public function testNumeroDez() {
    	$m = new MatematicaMaluca();
    	$resultado = $m->contaMaluca(10);
    	$this->assertEquals(10 * 2, $resultado, 'Houve um erro na conta para numero 10');
    }
}
