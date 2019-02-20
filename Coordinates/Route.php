<?php


namespace Coordinates;

/**
 * Accumulates instructions how to get to the destination.
 * Calculates destination coordinates by following instructions
 * @package Coordinates
 */
class Route
{
    /** @var Instruction[] */
    private $instructions = [];

    /** @var Position */
    private $startingPosition;

    /**
     * Angle is not an azimuth. Generally azimuth may be calculated as angle-90.
     * But in this task it's much more convenient to operate by angles
     * Here east is 0 degrees, north is 90 degrees
     * @var float
     */
    private $angle = 0.0;

    private $currentPosition;

    public function __construct(Position $startingPosition, float $azimuth)
    {
        $this->startingPosition = $startingPosition;
        $this->currentPosition = $startingPosition;
        $this->angle = $azimuth;
    }

    public function addInstruction(Instruction $instruction): Route
    {
        $this->instructions[] = $instruction;
        return $this;
    }

    public function updatePosition(Position $newPosition): void
    {
        $this->currentPosition = $newPosition;
    }

    public function turnAngle(float $turnAngle)
    {
        $this->angle = ($this->angle+$turnAngle) % 360;
    }

    public function getAngle():float
    {
        return $this->angle;
    }

    public function getCurrentPosition():Position
    {
        return $this->currentPosition;
    }

    public function calculateRoute(): Position
    {
        $this->currentPosition = $this->startingPosition;
        foreach ($this->instructions as $instruction) {
            $instruction->follow($this);
        }
        return $this->currentPosition;
    }
}