<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Category;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Page::truncate();
        // Page::factory(70)->create();

        $categories = Category::all();
        Page::all()->each(function ($page) use ($categories) {
            $page->categories()->sync($categories->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}
