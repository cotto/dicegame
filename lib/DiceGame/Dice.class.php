<?php

namespace DiceGame;


class Dice {

  private $diceValue;

  public function __construct($i) {
      if (!is_int($i)) {
          throw new Exception("must pass an integer to Dice constructor");
      }
      if ($i < 2) {
          throw new Exception("Dice can't have fewer than 2 sides.");
      }
      $this->diceValue = $i;
  }

  public function roll() {
      return rand(0, $this->diceValue);
  }

}
