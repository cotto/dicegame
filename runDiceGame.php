<?php

require_once 'autoloader.php';

use \DiceGame\Game;
use \DiceGame\Dice;
use \DiceGame\Player;


$game = new Game();
$game->enableDebugOutput();

$d6 = new Dice(6);
$game->setDice($d6);

$p1 = new Player();
$game->addPlayer($p1);
$p2 = new Player();
$game->addPlayer($p2);
$p3 = new Player();
$game->addPlayer($p3);
$p4 = new Player();
$game->addPlayer($p4);

$game->playGame();
