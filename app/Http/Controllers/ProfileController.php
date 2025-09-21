<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\Favorite;
use Illuminate\Validation\Rules\File;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());



        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }



        $request->user()->save();



        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {

        $user = $request->user();

        //Si le user n'utilise pas Socialite, on valide le mot de passe
        if (!($user->isSocialite())) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function my_recipes(Request $request)
    {
        //menu d'admin d'un utilisateur sur ses recettes
        $recipes = Recipe::whereBelongsTo($request->user())->get();
        return view('profile.my-recipes', ['recipes' => $recipes]);
    }

    public function my_comments(Request $request)
    {
        //menu d'admin d'un utilisateur sur ses commentaires
        $comments = Comment::whereBelongsTo($request->user())->get();
        return view('profile.my-comments', ['comments' => $comments]);
    }

    public function my_favorites(Request $request)
    {
        //Permet à l'utilisateur.ice de voir ses favoris
        $recipes = [];
        $favorites = Favorite::where('user_id', auth()->user()->id)->get();
        foreach ($favorites as $favorite) {
            $recipes[] = Recipe::find($favorite->recipe_id);
        }
        return view('profile.my-favorites', ['recipes' => $recipes]);
    }
}

