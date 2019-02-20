<?php

namespace API;

interface Output
{
    public function write(string $outputString): bool;
}