<?php
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ReportCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

///DEFAULT PROFILE
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/////Mail Check new user ////
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect(route('home'));
})->middleware(['auth', 'signed']);

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//////PASSWORD RESET /////
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {

    return view('auth.reset-password', ['token' => $token]);

})->middleware('guest')->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
    $status = Password::reset(

        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
    );
    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

////NOS PROFILS
Route::get('/profile/myrecipes', [ProfileController::class, 'my_recipes'])->name('profile.recipes')
    ->middleware(['auth', 'verified']);
Route::get('/profile/mycomments', [ProfileController::class, 'my_comments'])->name('profile.comments')
    ->middleware(['auth', 'verified']);
Route::get('/profile/myfavorites', [ProfileController::class, 'my_favorites'])->name('profile.favorites')
    ->middleware(['auth', 'verified']);

Route::patch('/user', [UserController::class, 'update'])->middleware(['auth', 'verified']);

//// ACCUEIL & CONTACT ////
Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/contact', [ContactController::class, 'index'])
    ->middleware('auth')
    ->name('contact.index');
Route::get('/contact/create', [ContactController::class, 'create'])
    ->name('contact.create');

//// RECETTES ////
Route::get('/recipes/create', [RecipeController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('recipes.create');

Route::post('/recipes', [RecipeController::class, 'store'])
    ->middleware(['auth', 'verified']);

//// RECETTES GUEST ////
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

//// RECETTES OWNER ////
Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->can('edit', 'recipe')->name('recipes.edit');

Route::patch('/recipes/{recipe}', [RecipeController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->can('edit', 'recipe');

Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->can('delete', 'recipe');


//// INGREDIENTS ////

Route::get('/ingredients', [IngredientController::class, 'index']);
Route::get('/ingredients/{ingredient}', [IngredientController::class, 'show']);


///////////COMMENTS///////////

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store']);
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])
        ->can('edit', 'comment');
    Route::get('/comments/{comment}/reply', [CommentController::class, 'reply']);
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])
        ->can('update', 'comment');
    Route::delete('/comments/{comment:id}', [CommentController::class, 'destroy'])
        ->can('delete', 'comment');
});

////////// ADMIN ////////////
Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(
    function () {
        Route::get('/admin', [AdminController::class, 'index'])->name(name: 'home.admin');
        Route::get('/admin/users', [UserController::class, 'admin_index']);
        Route::get('/admin/recipes', [RecipeController::class, 'admin_index']);
        Route::get('/admin/comments', [CommentController::class, 'admin_index']);
        Route::get('/admin/reported', [AdminController::class, 'reported_index']);
        Route::get('/admin/reported-recipes', [AdminController::class, 'reportedRecipes']);
        Route::get('/admin/reported-comments', [AdminController::class, 'reportedComments']);
        Route::patch('/admin/usersupdate', [AdminController::class, 'update_user_role']);
        Route::patch('/reportcomments', [ReportCommentController::class, 'reset_reports_comment']);
        Route::patch('/reportrecipes', [ReportController::class, 'reset_reports_recipe']);
    }
);

//// RATINGS ////
Route::middleware('auth')->group(function () {
    Route::post('/ratings', [RatingController::class, 'store']);
    Route::patch('/ratings/{rating}', [RatingController::class, 'update'])
        ->can('update', 'rating');
    Route::delete('/ratings/{rating}', [RatingController::class, 'destroy'])
        ->can('delete', 'rating');
});

//// TAGS ///// 
Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{tag}', [TagController::class, 'show']);

/////////////FAVORITES//////////////
Route::middleware('auth')->group(function () {
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy']);
});

//// SOCIALITE ////
Route::get('/login/redirect/github', [SocialiteController::class, 'redirect']);
Route::get('/login/github/callback', [SocialiteController::class, 'callback']);


///// NEWSLETTER ////////
Route::post('/newsletter', [NewsletterController::class, 'store']);
Route::patch('/newsletter', [NewsletterController::class, 'update']);


////Routes temporaires ////
//affichages des recipes et comments d'un user

Route::get('/users/{user}', [UserController::class, 'show']);
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(['auth']);
Route::get('/usr/', function () {
    return view('tests.avatar-update');
});


 Route::post('/reports', [ReportController::class, 'store']);
//route de test de mail
/* Route::get('testmail', function () {
    \Illuminate\Support\Facades\Mail::to('lvm@lvm.net')->send(
        new \App\Mail\RecipeCreated()
    );
    return 'Done';
}); */



require __DIR__ . '/auth.php';