<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Menambahkan beberapa kategori
         Category::create(['name' => 'Technology']);
         Category::create(['name' => 'Health']);
         Category::create(['name' => 'Sports']);
    }
}