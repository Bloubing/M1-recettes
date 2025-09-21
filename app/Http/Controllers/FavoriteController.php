<?php

namespace App\Http\Controllers;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store()
    {

        $recipe_id = request("recipe_id");

        //Vérification que le favoris n'existe pas déjà.
        if (
            !
            Favorite::where('recipe_id', $recipe_id)
                ->where('user_id', auth()->user()->id)
                ->exists()
        ) {
            //enregistrement du favoris
            Favorite::create([
                'user_id' => auth()->user()->id,
                'recipe_id' => $recipe_id,

            ]);
        }

        return redirect('/recipes/' . request('recipe_url'));
    }


    public function destroy(Favorite $favorite)
    {
        $recipe = $favorite->recipe;
        $favorite->delete();
        return redirect('/recipes/' . $recipe->url);
    }
}
