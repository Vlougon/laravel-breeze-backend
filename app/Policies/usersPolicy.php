<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class usersPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAssistants(User $user): bool
    {
        if ($user->role === 'supervisor') {

            return true;

        } else {

            return false;
        }
    }
}
