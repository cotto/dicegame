<?php

namespace DiceGame;

class ScoringRules {

  public function rollValue($i) {
      if ($i == 4) {
          return 0;
      }
      return $i;
  }

}
