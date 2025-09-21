<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des rôles administrateur et modérateur
        Role::factory()->create([
            'name' => 'admin'
        ]);

        Role::factory()->create([
            'name' => 'moderator'
        ]);
    }
}
