<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;

class FakeTwoFactorService implements TwoFactorServiceInterface
{
    public function link(User $user): void
    {
        // do nothing
    }

    /**
     * @inheritDoc
     */
    public function verify(User $user, string $code): bool
    {
        $validator = Validator::make(
            [
                'code' => $code,
            ],
            [
                'code' => 'int|max:444444'
            ],
            [
                'code.min' => 'invalid code'
            ]
        );

        if ($validator->validate()) {
            return true;
        }

        return false;
    }
}
