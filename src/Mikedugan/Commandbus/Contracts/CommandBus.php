<?php namespace Commandbus\Contracts;

interface CommandBus
{
    public function execute($command);
} 
