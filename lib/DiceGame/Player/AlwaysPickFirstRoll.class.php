<?php

namespace DiceGame\Player;


class AlwaysPickFirstRoll extends \DiceGame\Player {

    protected function decideWhichRollsToKeep($rollValues) {
        return array_pad(array(1), count($rollValues), 0);
    }

    public function getStrategyName() {
        return "always pick the first roll";
    }

}
