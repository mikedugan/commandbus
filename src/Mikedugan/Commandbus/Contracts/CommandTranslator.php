<?php  namespace Mikedugan\Commandbus\Contracts;

interface CommandTranslator
{
    public function toCommandHandler();
    public function toCommandValidator();
} 
