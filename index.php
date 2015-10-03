<?php
require_once 'class/Usuario.php';
require_once 'class/Leilao.php';
require_once 'class/Lance.php';
require_once 'class/Avaliador.php';

$leilao = new Leilao('Carro Gol Zero');
$avaliador = new Avaliador();

$user1 = new Usuario('Renato', 1);
$user2 = new Usuario('Ricardo', 2);
$user3 = new Usuario('Roberto', 3);

$leilao->propoe(new Lance($user1, 300));
$leilao->propoe(new Lance($user2, 200));
$leilao->propoe(new Lance($user1, 100));
$leilao->propoe(new Lance($user2, 200));
$leilao->propoe(new Lance($user1, 100));
$leilao->propoe(new Lance($user2, 200));
$leilao->propoe(new Lance($user1, 100));

$avaliador->avalia($leilao);

var_dump($avaliador);