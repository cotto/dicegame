<?php

namespace DiceGame;


class Dice {

  // number of faces that this die has
  private $size;

  public function __construct($i) {
      if (!is_int($i)) {
          throw new Exception("must pass an integer to Dice constructor");
      }
      if ($i < 2) {
          throw new Exception("Dice can't have fewer than 2 sides.");
      }
      $this->size = $i;
  }

  public function size() {
      return $this->size;
  }

  public function roll() {
      return rand(1, $this->size);
  }

}
