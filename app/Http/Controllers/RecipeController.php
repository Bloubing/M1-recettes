<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Support\Facades\Route;
use App\Models\Tag;
use App\Models\Ingredient;
use App\Http\Controllers\FileRecipeController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use \Illuminate\Support\Facades\Mail;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //models + relations en une seule query pour éviter le N+1
        //$recipes = Recipe::with('tags')->with('ratings')->where('status', 'published')->get()->sortByDesc("created_at");
        $recipes = Recipe::where('status', 'published')->with('tags')->with('ratings')->latest()->simplePaginate(8);
        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function admin_index()
    {
        // Affiche un 404 si utilisateur non admin essaie de voir la page
        if (!request()->user()->isAdmin()) {
            abort(404);
        }

        $recipes = Recipe::orderBy('title')->paginate(20);
        return view('admin.all-recipes', ['recipes' => $recipes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $main_tags = Tag::whereBetween('id', [1, 5])->get();
        return view('recipes.create', ['main_tags' => $main_tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Vérifie que la recette contient au minimum deux ingrédients
        $ingredients = request('ingredients');
        $i = 0;
        foreach ($ingredients as $ingredient) {
            if (!($ingredient['amount'] == null && $ingredient['name'] == null )) {
                // Vérifie que la partie 'amount' de chaque ingrédient est un nombre
                if (!(is_numeric($ingredient['amount']))) {
                    return back()->withErrors(['ingredients' => 'La quantité doit être un nombre.'])->withInput();
                }
                $i = $i + 1;
            }
        }
        if ($i < 2) {
            return back()->withErrors(['ingredients' => 'La recette doit contenir au moins deux ingrédients.'])->withInput();
        }
        if (request('tag1' == null)) {
            return back()->withErrors(['tag1' => 'La recette doit contenir au moins un tag'])->withInput();
        }

        ///////////// VALIDATION /////////////////////
        $request->validate([
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:3'],
            'servings' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'min:3'],
            'tag1' => ['required', 'min:3'],
            'tag2' => ['nullable', 'min:3'],
            'tag3' => ['nullable', 'min:3'],
            'status' => ['required'],
            'image_files' => ['nullable'],
            'image_files.*' => [
                'nullable',
                File::image() //vérifie si c'est bien une image
                    ->min('1kb')
                    ->max('8mb') //value max par défaut pour le etc/php/x.x/cli/php.ini
            ]
        ]);


        /////////////// CREATION DU MODEL //////////////////////
        $title = request('title');

        //Création si nécessaire d'une URL unique
        $url = preg_replace('/[^a-zA-Z0-9-]/s', '-', $title);
        while (Recipe::where('url', $url)->exists()) {
            $url .= strval(rand(0, 9));
        }

        $recipe = Recipe::create([
            'title' => $title,
            'content' => request('content'),
            'status' => request('status'),
            //remplacer tous les caractères spéciaux par '-'
            'url' => $url,
            'user_id' => $request->user()->id
        ]);

        if ($request->has('image_files')) {
            $images = [];
            foreach ($request->file('image_files') as $image) {

                $image_path = $image->store('recipes_img/' . $recipe->id, 'public');
                $images[] = '/storage/' . $image_path;

            }

            FileRecipeController::storeOrUpdateFiles($images, $recipe->id);

        }

        // Ingrédients -------------------------------------        
        $servings = request('servings');
        $ingredientData = [];
        foreach ($ingredients as $ingredient) {
            if (!empty($ingredient['name'])) {
                $ingredientModel = Ingredient::firstOrCreate(['name' => $ingredient['name']]);
                $ingredientData[$ingredientModel->id] = [
                    'amount' => $ingredient['amount'],
                    'unit' => $ingredient['unit'],
                    'servings' => $servings
                ];
            }
        }
        // Met à jour les ingrédients à la recette
        $recipe->ingredients()->sync($ingredientData);

        // Tags --------------------------------------------
        // Récupère les tags entrés
        $tag1 = request('tag1');
        $tag2 = request('tag2');
        $tag3 = request('tag3');

        // Convertit la chaîne en tableau de tags
        $tags = [$tag1, $tag2, $tag3];

        // Filtre les tags vides
        $tags = array_filter($tags, function ($tagName) {
            return !empty($tagName); //vérifie si le tag n'est pas vide
        });

        // Crée les tags
        $tags_to_keep = [];
        foreach ($tags as $tagName) {
            $tags_to_keep[] = Tag::firstOrCreate(['name' => $tagName]);
        }

        // Attache chacun des tags à la recette
        foreach ($tags_to_keep as $tagName) {
            $recipe->tags()->attach($tagName->id);
        }

        // Envoie d'un mail de confirmation de la création de recette
        Mail::to($recipe->user)->queue(
            new \App\Mail\RecipeCreated($recipe)
        );

        return redirect('/recipes')->with('message', 'Votre recette a été créée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //récupération des commentaires qui ne sont pas des réponses.
        // avec leurs réponses associées pour éviter le N+1
        $comments = Comment::whereBelongsTo($recipe)->whereNull('parent_id')->with('children')->get()->sortByDesc('created_at');

        $ratings = $recipe->ratings;
        $user = $recipe->user;
        $files = $recipe->files;


        return view('recipes.show', [
            'recipe' => $recipe,
            'user' => $user,
            'comments' => $comments,
            'ratings' => $ratings,
            'files' => $files,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //récupère les noms des anciens tag dans un tableau
        $tags = $recipe->tags->pluck('name')->toArray();
        //Récupération des tags principaux
        $main_tags = Tag::whereBetween('id', [1, 5])->get();

        return view('recipes.edit', [
            'recipe' => $recipe,
            'tags' => $tags,
            'main_tags' => $main_tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        // Vérifie que la recette contient au minimum deux ingrédients
        $ingredients = request('ingredients');
        //dd($ingredients);
        $i = 0;
        foreach ($ingredients as $ingredient) {
            if (!($ingredient['amount'] == null && $ingredient['name'] == null )) {
                // Vérifie que la partie 'amount' de chaque ingrédient est un nombre
                if (!(is_numeric($ingredient['amount']))) {
                    return back()->withErrors(['ingredients' => 'La quantité doit être un nombre.'])->withInput();
                }
                $i = $i + 1;
            }
        }
        if ($i < 2) {
            return back()->withErrors(['ingredients' => 'La recette doit contenir au moins deux ingrédients.'])->withInput();
        }

        if (request('tags.0' == null)) {
            return back()->withErrors(['tags.0' => 'La recette doit contenir au moins un tag'])->withInput();
        }
        $request->validate([
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:3'],
            'price' => ['required', 'min:3'],
            'tags.0' => ['required', 'min:3'],  //valide chaque tag du tableau tags
            'tags.1' => ['nullable', 'min:3'],  //valide chaque tag du tableau tags
            'tags.2' => ['nullable', 'min:3'],  //valide chaque tag du tableau tags

            'image_files' => ['nullable'],
            'status' => ['required'],
            'image_files.*' => [
                'nullable',
                File::image() //vérifie si c'est bien une image
                    ->min('1kb')
                    ->max('8mb') //value max par défaut pour le cli/php.ini
            ]
        ]);

        $title = request('title');

        //Création si nécessaire d'une URL unique
        $url = preg_replace('/[^a-zA-Z0-9-]/s', '-', $title);
        while (Recipe::where('url', $url)->exists()) {
            $url .= strval(rand(0, 9));
        }

        $recipe->update([
            'title' => $title,
            'content' => $request->content,
            'price' => $request->price,
            'url' => preg_replace('/[^a-zA-Z0-9-]/s', '-', $title),
            'status' => request('status')
        ]);

        if ($request->has('image_files')) {
            $images = [];

            foreach ($request->file('image_files') as $image) {

                $image_path = $image->store('recipes_img/' . $recipe->id, 'public');
                $images[] = '/storage/' . $image_path;

            }

            FileRecipeController::storeOrUpdateFiles($images, $recipe->id);

        }

        // Ingrédients -------------------------------------
        $servings = $recipe->ingredients()->first()->pivot->servings;

        // Créé ou récupère l'ingrédient correspondant à celui saisi
        $ingredientData = [];
        foreach ($ingredients as $ingredient) {
            if (!empty($ingredient['name'])) {
                $ingredientModel = Ingredient::firstOrCreate(['name' => $ingredient['name']]);
                $ingredientData[$ingredientModel->id] = [
                    'amount' => $ingredient['amount'],
                    'unit' => $ingredient['unit'],
                    'servings' => $servings
                ];
            }
        }

        // Met à jour les ingrédients à la recette
        $recipe->ingredients()->sync($ingredientData);

        // Tags --------------------------------------------
        $tags = request('tags');

        $tags = array_filter($tags, function ($tagName) {
            return !empty($tagName);
        });

        $tagsIds = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagsIds[] = $tag->id;
        }

        TagController::clean_tags($tagsIds);

        $recipe->tags()->sync($tagsIds);

        return redirect('/recipes/' . $recipe->url)->with('message', 'Votre recette a été modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        // On stocke l'URL pour pouvoir revenir à la bonne page après le DELETE
        // selon qu'on vient de admin, de myrecipes ou de recipe
        $url = url()->previous();
        $recipe->delete();

        //On vérifie si l'URL précédente est admin ou myrecipes
        if (
            str_starts_with($url, env("APP_URL") . "/admin")
            || str_starts_with($url, env("APP_URL") . "/profile/myrecipes")
        ) {

            return back()->with('message', 'Votre recette a été supprimée avec succès !');
        }
        return redirect('/recipes')->with('message', 'Votre recette a été supprimée avec succès !');
    }

}
