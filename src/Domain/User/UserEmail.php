<?php

namespace Src\Domain\User;

use Exception;

class UserEmail
{
    private string $value;

    /**
     * @throws Exception
     */
    public function __construct(string $email)
    {
        $this->checkValidEmail($email);
        $this->value = $email;
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @throws Exception
     */
    private function checkValidEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
    }
}
