<?php

namespace Src\Domain\User;

use Exception;

class UserName
{
    private string $value;

    /**
     * @throws Exception
     */
    public function __construct(string $name)
    {
        $this->checkValidName($name);
       $this->value = $name;
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * Domain rules:
     * * the user's name can only be one word
     * @throws Exception
     */
    private function checkValidName(string $value)
    {
        if (count(explode(' ', $value)) > 1) {
            throw new Exception("User's names can only consist on one word");
        }
    }
}
