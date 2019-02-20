<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'autoload.php';

$stdIn = new \API\StdIn();
$stdOut = new \API\StdOut();
$inputLineIterator = $stdIn->getLineIterator();
$endOfInput = false;
while (!$endOfInput) {
    $command = new \AllDifferentDirections\FindAverageDirectionCommand();
    $command->Execute($stdIn, $stdOut);
    $endOfInput = $inputLineIterator->current() === null;
}