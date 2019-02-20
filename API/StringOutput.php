<?php


namespace API;


class StringOutput implements Output
{
    /** @var string */
    private $outputString='';


    public function write(string $outputString): bool
    {
        $this->outputString .= $outputString;
        return true;
    }

    public function getOutputString(): string
    {
        return $this->outputString;
    }
}