<?php namespace Commandbus;

class CommandTranslator {

    public function toCommandHandler($command)
    {
        $handler = $this->assembleNamespace(get_class($command));
        if (! class_exists($handler)) {
            $message = "Command handler [$handler] does not exist.";
            throw new \Exception($message);
        }

        return $handler;
    }

    public function toValidator($command)
    {
        return str_replace('Command', 'Validator', get_class($command));
    }

    private function assembleNamespace($str)
    {
        $parts = explode('\\', $str);
        $class = array_pop($parts);
        $class = str_replace('Command', 'Handler', $class);
        return implode('\\', $parts).'\\'.$class;
    }
} 
