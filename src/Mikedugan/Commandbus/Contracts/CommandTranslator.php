<?php namespace Commandbus\Contracts;

interface CommandTranslator
{
    public function toCommandHandler();
    public function toCommandValidator();
} 
