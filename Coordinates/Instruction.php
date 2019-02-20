<?php


namespace Coordinates;


abstract class Instruction
{
    abstract public function follow(Route $route);
}