<?php

namespace Src\Domain;

interface UserRepository
{
    public function save(User $user): void;
    public function find(int $id): ?User;
}
