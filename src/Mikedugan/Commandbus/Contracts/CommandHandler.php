<?php namespace Commandbus\Contracts;

interface CommandHandler
{
    public function handle(CommandRequest $command);
} 
