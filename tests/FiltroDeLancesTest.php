<?php
require_once 'class/FiltroDeLances.php';
require_once 'class/Usuario.php';

class FiltroDeLancesTest extends PHPUnit_Framework_TestCase
{

    public function testDeveSelecionarLancesEntre1000E3000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $resultado = [];
        $resultado[] = new Lance($joao,2000);
        $resultado[] = new Lance($joao,1000); 
        $resultado[] = new Lance($joao,3000); 
        $resultado[] = new Lance($joao,800); 

        $resultado = $filtro->filtra($resultado);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(2000, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesEntre500E700() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $resultado = [];
        $resultado[] = new Lance($joao,600);
        $resultado[] = new Lance($joao,500); 
        $resultado[] = new Lance($joao,700); 
        $resultado[] = new Lance($joao,800); 

        $resultado = $filtro->filtra($resultado);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(600, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesAcima5000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $resultado = [];
        $resultado[] = new Lance($joao,5001); 
        $resultado[] = new Lance($joao,700); 
        $resultado[] = new Lance($joao,800); 

        $resultado = $filtro->filtra($resultado);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(5001, $resultado[0]->getValor(), 0.00001);
    }

    public function testNaoDeveSelecionarLancesForaDoFiltro() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $resultado = [];
        $resultado[] = new Lance($joao,1000); 
        $resultado[] = new Lance($joao,3000); 
        $resultado[] = new Lance($joao,500); 
        $resultado[] = new Lance($joao,700); 
        $resultado[] = new Lance($joao,5000);

        $resultado = $filtro->filtra($resultado);

        $this->assertEquals(0, count($resultado));
    }
}