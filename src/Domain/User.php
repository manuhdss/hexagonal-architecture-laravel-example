<?php

namespace Src\Domain;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Src\Domain\User\UserEmail;
use Src\Domain\User\UserName;
use Src\Domain\User\UserPassword;

class User
{
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;

    public function __construct(UserName $name, UserEmail $email, UserPassword $password)
    {
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
    }

    #[Pure] #[ArrayShape(['name' => "string", 'email' => "string", 'password' => "string"])]
    public function toPrimitives(): array
    {
        return [
            'name' => $this->name->value(),
            'email' => $this->email->value(),
            'password' => $this->password->value()
        ];
    }

    public static function fromPrimitives(array $data): User
    {
        return new self(
            new UserName($data['name']),
            new UserEmail($data['email']),
            new UserPassword($data['password'])
        );
    }
}
