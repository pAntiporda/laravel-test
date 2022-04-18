<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Category;
use \App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Category::truncate();

        User::factory(3)->create();
        $personal = Category::create(['name' => 'Personal', 'slug' => 'personal']);
        $work = Category::create(['name' => 'Work', 'slug' => 'work']);
        Category::create(['name' => 'Family', 'slug' => 'family']);
        Post::create([
            'category_id' => $personal->id,
            'user_id' => User::first()->id,
            'title' => 'First Post',
            'slug' => 'first-post',
            'excerpt' => 'This is the first post',
            'body' => 'This is the first post'
        ]);
        Post::create([
            'category_id' => $work->id,
            'user_id' => User::first()->id,
            'title' => 'Second Post',
            'slug' => 'second-post',
            'excerpt' => 'This is the second post',
            'body' => 'This is the second post'
        ]);
    }
}
