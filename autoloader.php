<?php

function __autoload($className) {
    $className = str_replace('\\', '/', $className);
    $possibleClassFile = "lib/$className.class.php";
    if (file_exists($possibleClassFile)) {
        require_once($possibleClassFile);
    }
}

