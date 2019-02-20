<?php


namespace Coordinates;

/**
 * Groups multiple positions in order to calculate center and radius
 * @package Coordinates
 */
class DestinationGroup
{
    /** @var Position[] */
    private $destinations = [];

    /** @var Position */
    private $center;

    public function addDestination(Position $destination): DestinationGroup
    {
        $this->destinations[] = $destination;
        $this->center = null;
        return $this;
    }

    public function calculateCenter(): Position
    {
        // use cached value. Caching is used because this method is also called within the class
        if ($this->center) {
            return $this->center;
        }
        if ($this->isEmpty()) {
            return new Position(0, 0);
        }
        $sumX = 0;
        $sumY = 0;
        foreach ($this->destinations as $destination) {
            $sumX += $destination->getX();
            $sumY += $destination->getY();
        }
        $destinationCount = count($this->destinations);
        $this->center = new Position(
            $sumX / $destinationCount,
            $sumY / $destinationCount
        );
        return $this->center;
    }

    /**
     * Calculates radius as the distance from the center to all points in group
     * @return float
     */
    public function calculateRadius():float
    {
        $center = $this->calculateCenter();
        $maxRadius = 0;
        foreach ($this->destinations as $destination) {
            $radius = Geometry::distance($center, $destination);
            $maxRadius = $radius > $maxRadius ? $radius : $maxRadius;
        }
        return $maxRadius;
    }

    public function isEmpty()
    {
        return \count($this->destinations)<1;
    }
}