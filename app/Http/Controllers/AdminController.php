<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Role;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\ReportComment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $number_reports = Report::groupBy('recipe_id')->having('count(user_id)', '>=', 10)->count() + ReportComment::groupBy('comment_id')->having('count(user_id)', '>=', 10)->count();



        return view('admin.home-admin', ['number_reports' => $number_reports]);
    }

    public function reported_index()
    {

        //Récupération des recettes et commentaires dont le nombre de signalements est >= 10
        $number_of_more_than_10_reports_recipes = Report::groupBy('recipe_id')->having('count(user_id)', '>=', 10)->count();
        $number_of_more_than_10_reports_comments = ReportComment::groupBy('comment_id')->having('count(user_id)', '>=', 10)->count();

        return view('admin.reported', [
            'number_of_recipes_reported' => $number_of_more_than_10_reports_recipes,
            'number_of_comments_reported' => $number_of_more_than_10_reports_comments
        ]);
    }

    public function reportedRecipes()
    {

        //Récupréation des recettes dont le nombre de signalements est >=10
        $reports = Report::groupBy('recipe_id')->having('count(user_id)', '>=', 10)->get();
        $reported_recipes = [];
        foreach ($reports as $report) {
            $reported_recipes[] = Recipe::find($report->recipe_id);
        }
        return view('admin.reported-recipes', ['reported_recipes' => $reported_recipes]);
    }

    public function reportedComments()
    {

        //Récupréation des commentaires dont le nombre de signalements est >=10
        $reportes = ReportComment::groupBy('comment_id')->having('count(user_id)', '>=', 10)->get();
        $reported_comments = [];
        foreach ($reportes as $reporte) {
            $reported_comments[] = Comment::find($reporte->comment_id);
        }
        return view('admin.reported-comments', ['reported_comments' => $reported_comments]);
    }

    public function update_user_role(Request $request)
    {

        $user_to_change = User::where('name', request('user_name'))->get()->first();

        $request->validate([
            'role' => ['required', 'min:3']
        ]);

        $admin = Role::where('name', 'admin')->get()->first();
        $moderator = Role::where('name', 'moderator')->get()->first();

        if (request('role') == 'user') {
            $user_to_change->roles()->sync([]);
        } elseif (request('role') == 'moderator') {
            $user_to_change->roles()->sync([$moderator->id]);
        } elseif (request('role') == 'admin') {
            $user_to_change->roles()->sync([$moderator->id, $admin->id]);
        }

        return redirect('/admin');
    }
}
