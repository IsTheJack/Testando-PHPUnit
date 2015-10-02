<?php
require 'class/Usuario.php';
require 'class/Leilao.php';
require 'class/Lance.php';
require 'class/Avaliador.php';

$leilao = new Leilao('Carro Gol Zero');
$avaliador = new Avaliador();

$user1 = new Usuario('Renato', 1);
$user2 = new Usuario('Ricardo', 2);
$user3 = new Usuario('Roberto', 3);

$leilao->propoe(new Lance($user1, 300));
$leilao->propoe(new Lance($user2, 200));
$leilao->propoe(new Lance($user3, 100));

$avaliador->avalia($leilao);

var_dump($avaliador);