<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment;
        $comment->post_id = 1;
        $comment->detail = 'This is first comment';
        $comment->save();

        factory(Comment::class, 3)->create([
            'post_id' => 2
        ]);

        factory(Comment::class, 2)->create([
            'post_id' => 3
        ]);
    }
}
