<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ReportComment;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class ReportCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3 commentaires avec plus de 10 signalements

        $comment_id = rand(1, Comment::count() - 3);
        for ($j = 0; $j < 3; $j += 1, $comment_id += 1) {
            $user_id = rand(1, User::count() - 12);
            for ($i = 0; $i < 12; $i += 1, $user_id += 1) {
                ReportComment::factory(1)
                    ->create([
                        'user_id' => $user_id,
                        'comment_id' => $comment_id
                    ]);
            }
        }
    }
}
