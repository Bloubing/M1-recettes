<?php

namespace App\Policies;
use App\Models\Rating;
use App\Models\User;

class RatingPolicy
{
    
    public function update(User $user, Rating $rating) {
        return ($rating->user->is($user)) || $user->isModerator();
    }

    public function delete(User $user, Rating $rating) {
        return ($rating->user->is($user)) || $user->isAdmin();
    }
}
