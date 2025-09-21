<?php

namespace App\Http\Controllers;

use App\Models\FileRecipe;
use Illuminate\Support\Facades\DB;


class FileRecipeController extends Controller
{
    public static function storeOrUpdateFiles($images, $recipe_id)
    {
        if (count($images) !== 0) {
            
            //On supprime les images existantes si de nouvelles sont ajoutées
            // pour ne pas avoir les images existantes en doublon
            DB::table('file_recipes')->where('recipe_id', '=', $recipe_id)->delete();

            // On stocke chaque élément de l'array images dans la table file_recipes
            foreach ($images as $image) {
                
                FileRecipe::create([
                'image_url' => $image,
                'recipe_id' => $recipe_id,
            
                ]);
            }
        }
    }

 }