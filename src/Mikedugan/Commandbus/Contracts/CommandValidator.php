<?php  namespace Mikedugan\Commandbus\Contracts;

interface CommandValidator
{
    public function validate(CommandRequest $command);
} 
