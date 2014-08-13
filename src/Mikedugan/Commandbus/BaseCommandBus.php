<?php  namespace Mikedugan\Commandbus;

class BaseCommandBus {

    private $commandTranslator;

    public function __construct()
    {
        $this->commandTranslator = new CommandTranslator();
    }

    public function execute($command)
    {
        $handler = $this->commandTranslator->toCommandHandler($command);

        return (new $handler)->handle($command);
    }
} 
