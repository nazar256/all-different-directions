<?php

namespace Math;

class Numbers
{
    public static function TrimTrailingZeroes(string $number):string
    {
        return strpos($number,'.')!==false ? rtrim(rtrim($number,'0'),'.') : $number;
    }
}