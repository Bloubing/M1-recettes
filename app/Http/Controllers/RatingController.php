<?php

namespace App\Http\Controllers;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store()
    {
        request()->validate([
            'stars' => ['required', 'numeric', 'between:1,5'],
        ]);

        $recipe_id = request("recipe_id");
        $stars = (int) request('stars');

        Rating::create([
            'stars' => $stars,
            'user_id' => auth()->id(),
            'recipe_id' => $recipe_id,

        ]);

        return redirect('/recipes/' . request('recipe_url'))->with('message', 'Votre note a été enregistrée avec succès ! ');
    }

    public function update(Rating $rating)
    {
        request()->validate([
            'stars' => ['required', 'numeric', 'between:1,5'],
        ]);

        $recipe = $rating->recipe;
        $stars = (int) request('stars');

        $rating->update([
            'stars' => $stars,
        ]);
        
        return redirect('/recipes/' . $recipe->url)->with("message", "Votre note a été modifiée avec succès !");
    }

    public function destroy(Rating $rating)
    {
        $recipe = $rating->recipe;
        $rating->delete();
        return redirect('/recipes/' . $recipe->url)->with("message", "Votre note a été supprimée avec succès !");
    }
}
