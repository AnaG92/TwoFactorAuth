<?php

namespace App\Services;

use App\Models\User;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;

class TwoFactorService implements TwoFactorServiceInterface
{
    public function __construct(
        public EnableTwoFactorAuthentication $enable,
        public ConfirmTwoFactorAuthentication $confirm
    ) {
    }

    public function link(User $user): void
    {
        $this->enable->__invoke($user);
    }

    /**
     * @inheritDoc
     */
    public function verify(User $user, string $code): bool
    {
        $this->confirm->__invoke($user, $code);

        return true;
    }
}
