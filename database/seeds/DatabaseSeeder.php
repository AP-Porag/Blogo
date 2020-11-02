<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Reply;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);

        factory(User::class,10)->create();
        factory(Category::class,15)->create();
        factory(Post::class,50)->create();
        factory(Tag::class,15)->create();
        factory(Comment::class,120)->create();
        factory(Reply::class,130)->create();
    }
}
