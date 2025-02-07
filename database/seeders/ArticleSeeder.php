<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Mengambil kategori secara acak
         $techCategory = Category::where('name', 'Technology')->first();
         $healthCategory = Category::where('name', 'Health')->first();
         $sportsCategory = Category::where('name', 'Sports')->first();

         // Menambahkan beberapa artikel yang berelasi dengan kategori
         Article::create([
             'title' => 'The Future of AI in Technology',
             'content' => 'Content about AI and its future in technology.',
             'slug' => 'the-future-of-ai-in-technology',
             'image' => 'tech_article_image.jpg',
             'category_id' => $techCategory->id,
         ]);

         Article::create([
             'title' => 'How to Stay Fit During Winter',
             'content' => 'Content about staying fit in the winter season.',
             'slug' => 'how-to-stay-fit-during-winter',
             'image' => 'health_article_image.jpg',
             'category_id' => $healthCategory->id,
         ]);

         Article::create([
             'title' => 'Top 10 Sports for Endurance Training',
             'content' => 'Content about sports for endurance training.',
             'slug' => 'top-10-sports-for-endurance-training',
             'image' => 'sports_article_image.jpg',
             'category_id' => $sportsCategory->id,
         ]);
     }
}
