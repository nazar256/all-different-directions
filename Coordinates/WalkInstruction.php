<?php


namespace Coordinates;


class WalkInstruction extends Instruction
{
    /** @var float */
    private $distance;

    public function __construct(float $distance)
    {
        $this->distance = $distance;
    }

    public function follow(Route $route)
    {
        $startingPoint = $route->getCurrentPosition();
        //east is 0 degrees, north is 90 degrees
        $angle = $route->getAngle();

        $radianAngle = deg2rad($angle);
        $walkX = $this->distance * cos($radianAngle);
        $walkY = $this->distance * sin($radianAngle);
        $route->updatePosition(
            new Position(
                $startingPoint->getX() + $walkX,
                $startingPoint->getY() + $walkY
            )
        );
    }
}