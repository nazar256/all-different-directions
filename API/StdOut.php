<?php


namespace API;


class StdOut implements Output
{
    public function write(string $outputString): bool
    {
        return fwrite(STDOUT, $outputString);
    }
}