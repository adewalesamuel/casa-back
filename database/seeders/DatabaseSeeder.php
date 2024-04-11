<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Region;
use App\Models\City;
use App\Models\Municipality;
use App\Models\Category;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $regions = Region::factory(10)->create();
        $categories = Category::factory(10)->create();
        $cities;
        $municipalities;

        foreach ($regions as $region) {
            $cities = City::factory(3)->for($region)->create();
        }

        foreach ($cities as $city) {
            $municipalities = Municipality::factory(4)->for($city)->create();
        }

        foreach ($municipalities as $municipality) {
            foreach ($categories as $category) {
                Product::factory()
                ->for($municipality)
                ->for($category)
                ->create();
            }
        }
    }
}
