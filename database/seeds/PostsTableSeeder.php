<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = 'admin@spacetaxi.com';
        $user->password = Hash::make('adminadmin');
        $user->name = 'Administrator';
        $user->role = 'ADMIN';
        $user->save();

        $post = new Post;
        $post->title = 'Hello World';
        $post->detail = 'This is Hello page';
        $post->user_id = $user->id;
        $post->save();

        factory(Post::class, 10)->create([
            'user_id' => $user->id
        ]);
    }
}
