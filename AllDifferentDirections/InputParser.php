<?php


namespace AllDifferentDirections;


use API\Input;
use Coordinates\Position;
use Coordinates\Route;
use Coordinates\TurnInstruction;
use Coordinates\WalkInstruction;

/**
 * Creates route iterator. Routes are parsed from lines of input
 * @package AllDifferentDirections
 */
class InputParser
{
    /** @var \Iterator */
    private $lineIterator;

    private $expectedLines = 0;

    public function __construct(Input $input)
    {
        $this->lineIterator = $input->getLineIterator();
        $line = $this->lineIterator->current();
        $this->lineIterator->next();
        \assert(is_numeric($line), 'expected directions count, got: ' . serialize($line));
        $this->expectedLines = (int)$line;
    }

    public function getRouteIterator(): \Iterator
    {
        while ($this->expectedLines > 0) {
            $line = $this->lineIterator->current();
            $this->lineIterator->next();
            $this->expectedLines--;
            $startX = 0.0;
            $startY = 0.0;
            $startAngle = 0;
            $nscanned = sscanf($line, '%f %f start %d', $startX, $startY, $startAngle);
            \assert($nscanned === 3, 'expected starting point and angle in line "'.$line.'"');
            $route = new Route(
                new Position($startX, $startY),
                $startAngle        //east is 0 degrees, north is 90 degrees
            );
            $routeParts = \array_slice(explode(' ', $line), 4);
            $currentOffset = 0;
            while ($currentOffset < count($routeParts)) {
                $instructionParts = array_slice($routeParts, $currentOffset, 2);
                \assert(count($instructionParts) === 2, 'expected instruction type and value');
                switch ($instructionParts[0]) {
                    case 'walk':
                        $route->addInstruction(new WalkInstruction((float)$instructionParts[1]));
                        break;
                    case 'turn':
                        $route->addInstruction(new TurnInstruction((float)$instructionParts[1]));
                        break;
                }
                $currentOffset+=2;
            }

            yield $route;
        }
    }
}