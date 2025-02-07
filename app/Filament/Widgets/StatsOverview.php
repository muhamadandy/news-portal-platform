<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {

        return [
            Stat::make('Jumlah Berita', Article::count()),
            Stat::make('Jumlah Pengguna', User::count()),
            Stat::make('Jumlah Kategori', Category::count()),
            Stat::make('Jumlah Komentar', Comment::count()),

        ];
    }
}