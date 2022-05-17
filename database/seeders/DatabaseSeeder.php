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
        // Only useful when seeding the database without clearing it up first but in our use case, we'll be using with migrate:fresh --seed instead.
        // User::truncate();
        // Category::truncate();

        // Our previous way of seeding data to the database prior to setting up factory for each model.
        // User::factory(3)->create();
        // User::factory(3)->create();
        // $personal = Category::create(['name' => 'Personal', 'slug' => 'personal']);
        // $work = Category::create(['name' => 'Work', 'slug' => 'work']);
        // Category::create(['name' => 'Family', 'slug' => 'family']);
        // Post::create([
        //     'category_id' => $personal->id,
        //     'user_id' => User::first()->id,
        //     'title' => 'First Post',
        //     'slug' => 'first-post',
        //     'excerpt' => 'This is the first post',
        //     'body' => 'This is the first post'
        // ]);
        // Post::create([
        //     'category_id' => $work->id,
        //     'user_id' => User::first()->id,
        //     'title' => 'Second Post',
        //     'slug' => 'second-post',
        //     'excerpt' => 'This is the second post',
        //     'body' => 'This is the second post'
        // ]);

        // Using factory to seed data to the database. Post factory method includes creating a new User and Category.
        // Post::factory(10)->create();

        // Override the default faker data in the factory to associate all Posts to a certain user. Would only override the given attributes, the rest would be fake.
        User::factory()->create([
            'name' => 'John Doe',
            'username' => 'johndoe',
        ]);

        Post::factory(15)->create([
            'user_id' => User::first()->id,
        ]);

        Post::factory()->create();
    }
}
