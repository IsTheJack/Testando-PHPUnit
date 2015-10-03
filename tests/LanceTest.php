<?php
require_once 'class/Usuario.php';
require_once 'class/Leilao.php';
require_once 'class/Lance.php';
require_once 'class/Avaliador.php';

/**
 * LanceTest
 *
 */
class LanceTest extends \PHPUnit_Framework_TestCase
{
	private $user;

	public function setUp() {
		$this->user = new Usuario("User 1");
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
    public function testDeveLancarExcecaoAoCriarLanceComValorZero() {
    	new Lance($this->user, 0);
    }

    /**
	 * @expectedException InvalidArgumentException
	 */
    public function testDeveLancarExcecaoAoCriarLanceComValorNegativo() {
    	new Lance($this->user, -1);
    }
}
