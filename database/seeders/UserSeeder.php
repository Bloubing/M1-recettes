<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Newsletter;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création de l'admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.test',
            'password' => 'admin'
        ])->roles()->attach(Role::find(1));
        User::find(1)->roles()->attach(Role::find(2));


        // Création du modérateur
        User::factory()->create([
            'name' => 'moderator',
            'email' => 'moderator@example.test',
            'password' => 'moderator'
        ])->roles()->attach(Role::find(2));


        //Création du user qui remplacera les users supprime.es
        User::factory()->create([
            'name' => 'Utilisateur·ice supprimé·e',
            'email' => 'admin2@example.test',
            'password' => 'admin'
        ]);

        // Utilisateur sans rôle
        User::factory()->create([
            'name' => 'flocon',
            'email' => 'flocon@example.test',
            'password' => 'flocon'
        ]);

        // Création de données aléatoires
        // pour 50 users supplémentaires
        for ($i = 0; $i < 50; $i += 1) {
            $user = User::factory()
                ->create();
            if ($i % 2 == 0) {
                Newsletter::create([
                    'email' => $user->email,
                ]);
            }
        }

    }
}
