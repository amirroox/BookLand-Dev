<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

//        Book::factory(10)->has(Category::factory()->count(3))->create();

        $categories = Category::all();

        Book::factory(100)->create()->each(function ($book) use ($categories) {
            $randomCategory = $categories->random();
            $book->categories()->attach($randomCategory);
        });
    }
}
