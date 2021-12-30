<?php

namespace Database\Seeders;

use App\Models\Ads;
use App\Models\AdsTag;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * truncates tables before seeding
         */
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        AdsTag::truncate();
        Ads::truncate();
        Category::truncate();
        Tag::truncate();

        /**
         * seeding table categories
         */
        Category::factory()->count(10)->create();

        /**
         * seeding table tags
         */
        Tag::factory()->count(10)->create();

        /**
         * seeding table ads
         */
        Ads::factory()->count(10)->create()->each(
            function ($ads){
                $tags = Tag::all()->random(mt_rand(1,5))->pluck('id');
                $ads->tags()->attach($tags);
            }
        );
        die();

    }
}
