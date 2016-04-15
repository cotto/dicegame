<?php

require_once 'autoloader.php';

use \DiceGame\Game;
use \DiceGame\Dice;
use \DiceGame\Player;
use \DiceGame\ScoringRules;


$game = new Game();
$game->enableDebugOutput();
$game->setDicePerTurn(5);

$scoringRules = new ScoringRules();
$game->setScoringRules($scoringRules);

$d6 = new Dice(6);
$game->setDice($d6);

$p1 = new Player('Aardvark');
$game->addPlayer($p1);
$p2 = new Player('Bacon');
$game->addPlayer($p2);
$p3 = new Player('Canyon');
$game->addPlayer($p3);
$p4 = new Player('Deer');
$game->addPlayer($p4);

$game->playGame();
