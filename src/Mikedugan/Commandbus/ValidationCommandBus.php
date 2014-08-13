<?php  namespace Mikedugan\Commandbus;

use Mikedugan\Commandbus\Contracts\CommandBus;
use Mikedugan\Commandbus\Contracts\CommandTranslator as TranslatorInterface;

class ValidationCommandBus implements CommandBus {

    private $commandBus;

    private $commandTranslator;

    function __construct(TranslatorInterface $commandTranslator = null)
    {
        $this->commandBus = new BaseCommandBus();
        $this->commandTranslator = $commandTranslator ? $commandTranslator : new CommandTranslator();
    }

    public function execute($command)
    {
        $validator = $this->commandTranslator->toValidator($command);

        if(class_exists($validator)) {
            $result = (new $validator)->validate($command);
            if(! empty($result)) {
                return $result;
            }
        }

        $this->commandBus->execute($command);
    }
} 
