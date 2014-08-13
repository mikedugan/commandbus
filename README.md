CommandBus
==========

PHP 5.4+ framework agnostic CommandBus

Usage
=====

This is a simple CommandBus implementation. It assumes you don't need to do a whole lot of customization, and leaves you to implement your own command and handlers.

Within your controller, instantiate a new CommandBus or ValidationCommandBus:

    use Commandbus\BaseCommandBus;
    use Commandbus\ValidationCommandBus;
    
    
    class myController {
    
        private $commandBus;
        
        //Laravel 4+ constructor
        public function __construct(ValidationCommandBus $commandBus)
        {
            $this->commandBus = $commandBus;
        }
        
        //General constructor
        public function __construct()
        {
            $this->commandBus = new ValidationCommandBus();
        }
        
This doesn't do anything until you create a command object and execute it with the bus. The command object itself is really just a fancy object that contains data being passed to the validator and handler. The object should implement CommandRequest as so:

    class MyCommand implements Commandbus\Contracts\CommandRequest {
        private $data;
        
        public function __construct($data)
        {
            $this->data = $data;
        }
    }
    
That's all you need for the command class.Create your own and instantiate it however you like in the controller. We will then want to pass the command to the command bus for execution:

    $command = new MyCommand($input);
    $results = $this->commandBus->execute($command);
    //do what you need to with the results, we'll return whatever you return from your handler
    
When you create your handler, they should implement Commandbus\Contracts\CommandHandler:

    class MyCommandHandler implements Commandbus\Contracts\CommandHandler {
        public function handle(CommandRequest $command)
        {
            //handle your command
        }
    }
    
Any data you wish to pass back should be in the form of a class implementing `Commandbus\Contracts\CommandResponse`. If you just need to return simple data like a string or array, you can use the provided `Commandbus\BaseCommandResponse` in a simple manner:

    return new Commandbus\BaseCommandResponse('success');
    
The constructor accepts $data and $errors, both of which default to `null`. 
    
If you are using the ValidationCommandBus, you will want to also have a validator available to handle this. It should implement the CommandValidator class:

    class MyCommandValidator implementes Commandbus\Contracts\CommandValidator {
        public function validate(CommandRequest $command)
        {
            //do validation
        }
        
        //if validation passes, return false
    }
    
Please note in the above that a passing validation should return false. Anything else will be prematurely returned by the CommandBus.

###Class Name Resolution

This package doesn't use any IoC or dependency injection features to resolve class names. Rather, we will simply look for the handler in the same namespace as the command that was passed to it. The following is how the validator and handler are resolved:

`Foo\App\RegisterUserCommand` would correspond to the handler and validator `Foo\App\RegisterUserHandler` and `Foo\App\RegisterUserValidator`, respectively.

You can pass in your own CommandTranslator (implementing `Commandbus\Contracts\CommandTranslator`) to both the `BaseCommandBus` and `ValidationCommandBus` if you need custom class name resolution.
