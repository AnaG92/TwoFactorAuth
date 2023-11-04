<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(public User $userModel)
    {
    }

    /**
     * @param string $username
     * @return User
     * @throws ModelNotFoundException
     */
    public function getUserByUsername(string $username): User
    {
        return $this->userModel
            ->where('username', $username)
            ->firstOrFail();
    }
}
