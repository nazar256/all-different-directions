<?php


namespace API;


interface Input
{
    public function getLineIterator(): \Iterator;
}