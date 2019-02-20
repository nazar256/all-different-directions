<?php


namespace API;


class StdIn implements Input
{
    /** @var \Iterator */
    private $lineIterator;

    public function __construct()
    {
        $this->lineIterator = $this->createLineIterator();
    }

    private function createLineIterator(): \Iterator
    {
        while($line = fgets(STDIN)){
            yield rtrim($line,"\n");
        }
    }

    public function getLineIterator(): \Iterator
    {
        return $this->lineIterator;
    }
}