<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{

    public function admin_index()
    {


        //Pagination de l'ensemble des commentaires
        $comments = Comment::paginate(20);
        return view('admin.all-comments', ['comments' => $comments]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'content' => ['required', 'min:3'],
        ]);

        // Créer un commentaire

        //Enregistrement du commentaire
        Comment::create([
            'user_id' => auth()->user()->id,
            'recipe_id' => request('recipe_id'),
            'content' => request('content'),
            'parent_id' => request('parent_id'),

        ]);


        //S'il s'agit d'une réponse, envoie d'un mail au user 'parent'
        if (request('parent_id') != null) {
            $parent = Comment::find(request('parent_id'))->first();
            Mail::to($parent->user)->queue(
                new \App\Mail\CommentAnswer($parent)
            );


        }

        return redirect('/recipes/' . request('recipe_url'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    public function reply(Comment $comment)
    {
        return view('comments.reply', ['parent_comment' => $comment]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $recipe = $comment->recipe;
        return view('comments.edit', ['comment' => $comment, 'recipe' => $recipe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
         // On stocke l'URL pour pouvoir revenir à la bonne page après le DELETE
        // selon qu'on vient de admin, mycomments ou home
        $url = url()->previous();

        if ($comment->has_been_deleted == 'yes' && !auth()->user()->isAdmin()) {
            return redirect('/recipes/' . $comment->recipe->url)->with("message", "Impossible de modifier un message supprimé");

        }
        $request->validate([
            'content' => 'required'
        ]);

        $recipe = $comment->recipe;


        $comment->update([
            'content' => request('content'),
        ]);

        //On vérifie si l'URL précédente est admin ou mycomments
        if (str_starts_with($url, env("APP_URL") . "/admin") || str_starts_with($url, env("APP_URL") . "/profile/mycomments")) {
            return back()->with("message", "Votre commentaire a été modifié avec succès !");
        }
        return redirect('/recipes/' . $recipe->url)->with("message", "Votre commentaire a été modifié avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // On stocke l'URL pour pouvoir revenir à la bonne page après le DELETE
        // selon qu'on vient de admin, mycomments ou home
        $url = url()->previous();

        //Commentaire non détruit, mais vidé du contenu
        //Commentaire non détruit, mais vidé du contenu pour garder la hiérarchie des réponses
        $comment->update(
            [
                'content' => "[Commentaire supprimé]",
                'has_been_deleted' => 'yes',
            ]
        );


        //On vérifie si l'URL précédente est admin ou mycomments
        if (str_starts_with($url, env("APP_URL") . "/admin") || str_starts_with($url, env("APP_URL") . "/profile/mycomments")) {
            return back()->with("message", "Votre commentaire a été supprimé avec succès !");
        }
        return redirect('/recipes/' . $comment->recipe->url)->with("message", "Votre commentaire a été supprimé avec succès !");

    }
}