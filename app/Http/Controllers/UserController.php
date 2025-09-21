<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\Role;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function admin_index()
    {
        // Afficher un 404 si utilisateur non admin essaie de voir la page


        $users = User::orderBy('name')->paginate(20);
        return view('admin.all-users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //permet de voir le profil public d'un.e utilisateur.rice
        $recipes = Recipe::whereBelongsTo($user)->get();
        $comments = Comment::whereBelongsTo($user)->latest()->get();
        $roles = Role::all();
        return view('users.show', [
            'user' => $user,
            'recipes' => $recipes,
            'comments' => $comments,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user_for_delete = User::find(3);
        $user_recipes = Recipe::where('user_id', $user->id)->get();
        foreach ($user_recipes as $recipe) {
            $recipe->update([
                'user_id' => $user_for_delete->id,
            ]);
        }

        $user_comments = Comment::where('user_id', $user->id)->get();
        foreach ($user_comments as $comment) {
            $comment->update([
                'user_id' => $user_for_delete->id,
            ]);
        }
        // On stocke l'URL pour pouvoir revenir à la bonne page après le DELETE
        // selon qu'on vient de admin ou pas
        $url = url()->previous();
        $user->delete();

        //On vérifie si l'URL précédente est admin
        if (str_starts_with($url, env("APP_URL") . "/admin/users")) {

            return back()->with("message", "L'utilisateur·ice a été supprimé avec succès ! ");
        }

        return redirect('/');
    }

}