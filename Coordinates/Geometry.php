<?php


namespace Coordinates;

/**
 * Performs some geometry calculations
 * @package Coordinates
 */
class Geometry
{
    /**
     * Calculates the distance between two 2D points
     * @param Position $from
     * @param Position $to
     * @return float
     */
    public static function distance(Position $from, Position $to): float
    {
        return sqrt((($to->getX() - $from->getX()) ** 2) + (($to->getY() - $from->getY()) ** 2));
    }
}