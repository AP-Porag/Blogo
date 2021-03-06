<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\PostTags;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(),
        'slug' => $faker->unique()->slug,
        'thumbnail' => $faker->imageUrl(),
    ];
});

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id'=>rand(1,10),
        'category_id'=>rand(1,15),
        'name' => $faker->unique()->sentence,
        'slug' => $faker->unique()->slug,
        'description' => $faker->paragraph,
        'thumbnail' => $faker->imageUrl(),
    ];
});

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(),
        'slug' => $faker->unique()->slug,
    ];
});

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id'=>rand(1,10),
        'post_id'=>rand(1,50),
        'comment' => $faker->unique()->sentence,
    ];
});

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id'=>rand(1,10),
        'comment_id'=>rand(1,120),
        'reply' => $faker->unique()->sentence,
    ];
});
$factory->define(PostTags::class, function (Faker $faker) {
    return [
        'post_id'=>rand(1,50),
        'tag_id'=>rand(1,15),
    ];
});
