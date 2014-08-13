<?php  namespace Mikedugan\Commandbus\Contracts;

interface CommandHandler
{
    public function handle(CommandRequest $command);
} 
