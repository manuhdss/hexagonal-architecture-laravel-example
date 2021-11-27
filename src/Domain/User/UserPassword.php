<?php

namespace Src\Domain\User;

use Exception;

class UserPassword
{
    private const MINIMUM_PASSWORD_LENGTH = 6;

    private string $value;

    /**
     * @throws Exception
     */
    public function __construct(string $password)
    {
        $this->checkValidPassword($password);
        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @throws Exception
     */
    private function checkValidPassword(string $value)
    {
        if (strlen($value) <= self::MINIMUM_PASSWORD_LENGTH) {
            throw new Exception("Password must be longer than " . self::MINIMUM_PASSWORD_LENGTH . " characters");
        }
    }
}
