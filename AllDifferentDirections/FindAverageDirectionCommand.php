<?php

namespace AllDifferentDirections;

use API\Command;
use API\Input;
use API\Output;
use Coordinates\DestinationGroup;
use Coordinates\Route;
use Math\Numbers;

/**
 * Receives from STDIN a set of directions "from people".
 * Calculates average destination and radius and prints to STDOUT
 * @package AllDifferentDirections
 */
class FindAverageDirectionCommand extends Command
{
    public function Execute(Input $input, Output $output)
    {
        $parser = new InputParser($input);

        $destinationGroup = new DestinationGroup();
        /** @var Route $route */
        foreach ($parser->getRouteIterator() as $route) {
            $destinationGroup->addDestination($route->calculateRoute());
        }
        if ($destinationGroup->isEmpty()) {
            return;
        }
        $center = $destinationGroup->calculateCenter();
        $radius = $destinationGroup->calculateRadius();
        $formattedX = Numbers::TrimTrailingZeroes(number_format($center->getX(), 4));
        $formattedY = Numbers::TrimTrailingZeroes(number_format($center->getY(), 4));
        $formattedRadis = Numbers::TrimTrailingZeroes(number_format($radius, 5));
        $output->write(
            sprintf(
                "%s %s %s\n",
                $formattedX,
                $formattedY,
                $formattedRadis
            )
        );
    }

}