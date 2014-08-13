<?php namespace Commandbus;

abstract class BaseCommandResponse implements CommandResponse
{
    protected $errors;

    protected $data;

    public function __construct($data = null, $errors = null)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

}
