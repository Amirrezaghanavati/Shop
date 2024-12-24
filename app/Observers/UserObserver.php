<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function creating(User $user): void
    {
        $user->ip    = request()->ip();
        $user->agent = request()->userAgent();
    }

    public function created(User $user): void
    {
        $user->assignRole('user');
    }

    public function updating(User $user): void
    {
        if ($user->ip != request()->ip()) {
            $user->ip = request()->ip();
        }

        if ($user->agent != request()->userAgent()) {
            $user->agent = request()->userAgent();
        }
    }
}
