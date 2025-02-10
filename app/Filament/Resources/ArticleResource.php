<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Article;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleResource\RelationManagers;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $modelLabel = 'Berita';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required(),
                Forms\Components\RichEditor::make('content')
                    ->label('Konten')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->directory('uploads')
                    ->disk('public')
                    ->image()
                    ->nullable(),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->disabled(),
                Forms\Components\Select::make('category_id')
                    ->label('Kategori')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\Toggle::make('is_highlighted')
                    ->label('Highlight Berita')
                    ->inline(false)
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_highlighted')
                    ->label('Highlighted')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Di Buat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_highlighted')
                    ->label('Highlight Only')
                    ->query(fn (Builder $query) => $query->where('is_highlighted', true)),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}