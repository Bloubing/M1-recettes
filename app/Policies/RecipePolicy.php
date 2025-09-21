<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use RegexIterator;

class RecipePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function edit(User $user, Recipe $recipe)
    {
        //Owner ou mod ou admin
        return $recipe->user->is($user) || $user->isModerator();
    }

    public function update(User $user, Recipe $recipe): bool
    {
        //Owner ou mod ou admin
        return $recipe->user->is($user) || $user->isModerator();
    }

    public function delete(User $user, Recipe $recipe)
    {
        //Owner or Admin
        return ($recipe->user->is($user)) || $user->isAdmin();
    }
}
