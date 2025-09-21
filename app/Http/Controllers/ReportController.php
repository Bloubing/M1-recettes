<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;


class ReportController extends Controller
{
    public function store()
    {

        $recipe_id = request("recipe_id");

        //Vérification que le report n'existe pas déjà.
        if (
            !
            Report::where('recipe_id', $recipe_id)
                ->where('user_id', auth()->id())
                ->exists()
        ) {

            Report::create([
                'user_id' => auth()->id(),
                'recipe_id' => $recipe_id,

            ]);
        }

        return redirect('/recipes/' . request('recipe_url'));
    }


    public function destroy(Report $report)
    {
        $recipe = $report->recipe;
        $report->delete();
        return redirect('/recipes/' . $recipe->url);
    }

    public function reset_reports_recipe(Request $request)
    {
        //permet aux admins de retirer tous les signalements d'une recette
        $reports = Report::where('recipe_id', request('recipe_id'))->get();
        foreach ($reports as $report) {
            $report->delete();
        }
        return redirect('/admin/reported-recipes');
    }
}

