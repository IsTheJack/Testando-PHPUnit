<?php
require 'class/AnoBissexto.php';

/**
 * AnoBissextoTest
 *
 */
class AnoBissextoTest extends \PHPUnit_Framework_TestCase
{
    public function testReconheceAnoBissexto() {
    	$ano = 2012;
    	$anoBissexto = new AnoBissexto($ano);
    	$this->assertTrue($anoBissexto->verificaAnoBissexto(), 'Nao reconheceu como ano bissexto.');
    }

    public function testReconheceAnoNaoBissexto() {
    	$ano = 2015;
    	$anoBissexto = new AnoBissexto($ano);
    	$this->assertFalse($anoBissexto->verificaAnoBissexto(), 'Reconheceu como bissexto um ano normal.');
    }
}
