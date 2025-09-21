<?php

namespace App\Policies;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FavoritePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function update(User $user, Favorite $favorite)
    {
        //Owner
        return ($favorite->user->is($user));
    }

    public function delete(User $user, Favorite $favorite)
    {
        //Owner
        return ($favorite->user->is($user));
    }
}
