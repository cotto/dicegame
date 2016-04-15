<?php

namespace DiceGame\Player;


class AlwaysPickLowestDie extends \DiceGame\Player {

    protected function decideWhichRollsToKeep($rollValues) {
        $picks = array();

        $minRollValue = 99;

        foreach ($rollValues as $rollValue) {
            if ($rollValue < $minRollValue) {
                $minRollValue = $rollValue;
            }
        }

        $foundLowest = false;
        foreach ($rollValues as $i => $rollValue) {
            if (!$foundLowest && $rollValue == $minRollValue) {
                $picks[] = 1;
                $foundLowest = true;
            }
            else {
                $picks[] = 0;
            }
        }

        return $picks;
    }

    public function getStrategyName() {
        return "pick one die each round with the lowest roll";
    }

}
