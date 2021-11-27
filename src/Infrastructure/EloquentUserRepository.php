<?php

namespace Src\Infrastructure;

use App\Models\User as EloquentUser;
use Src\Domain\User;
use Src\Domain\UserRepository;

class EloquentUserRepository implements UserRepository
{
    public function save(User $user): void
    {
        $user_data = $user->toPrimitives();
        EloquentUser::create($user_data);
    }

    public function find(int $id): ?User
    {
        $match = EloquentUser::find($id);
        if (!$match) return null;

        ['name' => $name, 'email' => $email, 'password' => $password] = $match;

        return User::fromPrimitives([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }
}
