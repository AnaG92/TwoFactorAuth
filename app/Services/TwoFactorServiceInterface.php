<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

interface TwoFactorServiceInterface
{
    public function link(User $user): void;
    /**
     * @param User $user
     * @param string $code
     * @return bool
     * @throws ValidationException
     */
    public function verify(User $user, string $code): bool;
}
