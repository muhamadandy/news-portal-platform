<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestComments extends BaseWidget
{
    protected static ?string $heading = 'Komentar Terbaru';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Comment::query()
                ->latest()
                ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('article.title')
                    ->label('Berita')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Komentar')
                    ->limit(50)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Di Buat')
                    ->dateTime()
                    ->sortable(),
            ]);
    }
}