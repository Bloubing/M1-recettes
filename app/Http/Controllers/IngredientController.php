<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = Ingredient::get()->sortBy("name");
        return view("ingredients.index", ["ingredients" => $ingredients]);
    }

   
    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', ["ingredient" => $ingredient]);
    }

}
