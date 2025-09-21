<?php

namespace App\Http\Controllers;

use App\Models\ReportComment;
use Illuminate\Http\Request;

class ReportCommentController extends Controller
{
    public function store()
    {

        $comment_id = request("comment_id");

        //Vérification que le report n'existe pas déjà puis enregistrement
        if (
            !
            ReportComment::where('comment_id', $comment_id)
                ->where('user_id', auth()->id())
                ->exists()
        ) {

            ReportComment::create([
                'user_id' => auth()->id(),
                'comment_id' => $comment_id,

            ]);
        }



        return redirect('/recipes/');
    }


    public function destroy(ReportComment $report)
    {
        $recipe = $report->comment->recipe;
        $report->delete();
        return redirect('/recipes/' . $recipe->url);
    }

    public function reset_reports_comment(Request $request)
    {
        //permet aux admin de retirer tous les signalements d'un commentaire
        $reports = ReportComment::where('comment_id', request('comment_id'))->get();
        foreach ($reports as $report) {
            $report->delete();
        }
        return redirect('/admin/reported-comments')->with('message','Les signalements du commentaire ont été réinitialisés avec succès !');
    }


}