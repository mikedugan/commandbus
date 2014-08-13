<?php namespace Commandbus\Contracts;

interface CommandValidator
{
    public function validate(CommandRequest $command);
} 
