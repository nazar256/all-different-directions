<?php


namespace API;


class StringInput implements Input
{
    private $inputString;

    public function __construct(string $inputString)
    {
        $this->inputString = $inputString;
    }

    public function getLineIterator(): \Iterator
    {
        foreach(preg_split("/((\r?\n)|(\r\n?))/", $this->inputString) as $line){
            yield $line;
        }
    }
}