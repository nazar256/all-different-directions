<?php
namespace API;

abstract class Command
{
    abstract public function Execute(Input $input, Output $output);
}