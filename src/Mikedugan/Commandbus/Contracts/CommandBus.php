<?php  namespace Mikedugan\Commandbus\Contracts;

interface CommandBus
{
    public function execute($command);
} 
