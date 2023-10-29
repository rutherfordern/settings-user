<?php

namespace App\Exceptions;

class InvalidVerificationMethod extends \Exception
{
    public function __construct(string $message = 'Неподдерживаемый метод верификации')
    {
        parent::__construct($message);
    }
}
