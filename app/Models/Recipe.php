<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content', 'title', 'price', 'url', 'status',];

    /**
     * Get the user that owns the recipe.
     */
    public function user()
    {
        // Une recette est écrite par une personne
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        // Une recette peut avoir plusieurs commentaires
        return $this->hasMany(Comment::class, 'recipe_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('amount', 'unit', 'servings');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function files()
    {
        return $this->hasMany(FileRecipe::class);
    }

    // Renvoie la note moyenne de la recette
    public function averageRating()
    {
        //renvoie la notation globale de la recette
        return round($this->ratings->avg('stars'), 1);
    }

    // Renvoie un booléen indiquant si l'utilisateur loggé a déjà noté la recette courante
    public function isRated()
    {
        return $this->ratings()
            ->where('user_id', auth()->id())
            ->exists();
    }

    // Renvoie la note donnée par l'utilisateur loggé à la recette courante
    public function userRating()
    {
        return $this->ratings()
            ->where('user_id', auth()->id())
            ->first();
    }

    // Pour que le model binding de la recette ne soit plus id par défaut mais URL
    public function getRouteKeyName()
    {
        return 'url';
    }

    public function isReported()
    {
        return $this->reports()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function nb_Reports()
    {
        return $this->reports()->count();
    }

    public function isFavored()
    {
        return $this->favorites()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function userFavorite()
    {
        return $this->favorites()
            ->where('user_id', auth()->id())
            ->first();
    }
}