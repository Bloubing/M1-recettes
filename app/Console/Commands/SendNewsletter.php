<?php

namespace App\Console\Commands;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Recipe;

use App\Mail\Newsletter;
use Illuminate\Support\Facades\Mail;

use Illuminate\Console\Command;
use PhpParser\Node\Expr\New_;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoie la newsletter';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //envoie la newsletter à tous les utilisateur.ices enregistré.e.s
        $dests = \App\Models\Newsletter::all();
        Mail::to(User::find(1))
            ->cc($dests->email)
            ->send(new Newsletter());

    }
}
