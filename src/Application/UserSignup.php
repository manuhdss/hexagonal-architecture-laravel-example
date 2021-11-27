<?php

namespace Src\Application;

use Src\Domain\UserRepository;
use Src\Domain\User;

class UserSignup
{
    private UserRepository $repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->repository = $user_repository;
    }

    public function signup(User $user): void
    {
        $this->repository->save($user);
    }
}
