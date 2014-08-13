<?php namespace Commandbus\Contracts;

interface CommandResponse {
    public function getData();
    public function setData($data);

    public function getErrors();
    public function setErrors($errors);
} 
