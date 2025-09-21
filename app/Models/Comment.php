<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'recipe_id', 'content', 'parent_id'];

    public function user()
    {
        //Un commentaire dépend d'un.e user
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recipe()
    {
        //Un commentaire dépend d'une recette
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }

    // Récupérer la note donnée à un user à la recette où se trouve le commentaire
    public function rating()
    {
        return Rating::where('user_id', '=', $this->user->id)
            ->where('recipe_id', '=', $this->recipe->id)
            ->value('stars');
    }

    public function reportcomments()
    {
        //Relation avec les signalements
        return $this->hasMany(ReportComment::class);
    }

    // Commentaire parent pour les réponses aux commentaires
    public function parent()
    {
        //Le commentaire répond à 'parent'
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    //Commentaires enfants pour les réponses aux commentaires
    public function children()
    {
        //Réponses au commentaire
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function isReported()
    {
        //Vérification si le commentaire a été signalé au moins une fois
        return $this->reportcomments()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function nb_Reports()
    {
        //nombre de signalements du commentaire
        return $this->reportcomments()->count();
    }




}