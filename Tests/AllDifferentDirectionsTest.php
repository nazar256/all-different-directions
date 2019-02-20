<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '../autoload.php';

const SAMPLE_TEST_CASES = [
    [
        'input' => "0\n",
        'output' => '',
    ],
    [
        'input' => "2\n30 40 start 90 walk 5\n40 50 start 180 walk 10 turn 90 walk 5\n",
        'output' => "30 45 0\n",
    ],
    [
        'input' => "3\n87.342 34.30 start 0 walk 10.0\n" .
            "2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60\n" .
            "58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5\n",
        'output' => "97.1547 40.2334 7.63097\n",
    ],
    [
        //any order of walk/turn
        'input' => "3\n87.342 34.30 start 0 walk 10.0\n" .
            "2.6762 75.2811 start -45.0 walk 5 walk 35 turn 40.0 walk 60\n" .
            "58.518 93.508 start 270 walk 50 turn 40 turn 50 walk 40 turn 13 walk 1 walk 4\n",
        'output' => "97.1547 40.2334 7.63097\n",
    ],
];

function testSampleInputOutput()
{
    foreach (SAMPLE_TEST_CASES as $n => $testCase) {
        $input = new \API\StringInput($testCase['input']);
        $output = new \API\StringOutput();
        $command = new \AllDifferentDirections\FindAverageDirectionCommand();
        $command->Execute($input, $output);
        $actualOutput = $output->getOutputString();
        \assert(
            $testCase['output'] === $actualOutput,
            'for case: ' . $n . ' expected output: ' . $testCase['output'] . ', but actual is: ' . $actualOutput
        );
    }
}


testSampleInputOutput();
echo("All tests passed!\n");
