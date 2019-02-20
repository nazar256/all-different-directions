<?php


namespace Coordinates;


class TurnInstruction extends Instruction
{
    private $angle;

    public function __construct(float $angle)
    {
        $this->angle = $angle;
    }

    public function follow(Route $route)
    {
        //A positive α indicates to turn to the left.
        //east is 0 degrees, north is 90 degrees
        $route->turnAngle($this->angle);
    }
}