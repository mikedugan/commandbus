<?php  namespace Mikedugan\Commandbus;

use Mikedugan\Commandbus\Contracts\CommandTranslator as TranslatorInterface;

class BaseCommandBus {

    private $commandTranslator;

    public function __construct(TranslatorInterface $commandTranslator = null)
    {
        $this->commandTranslator = $commandTranslator ? $commandTranslator : new CommandTranslator();
    }

    public function execute($command)
    {
        $handler = $this->commandTranslator->toCommandHandler($command);

        return (new $handler)->handle($command);
    }
} 
