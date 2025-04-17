<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Http\Request;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function creating(User $user, Request $request): void
    {
        dd($request);
    }
}
