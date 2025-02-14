<?php

namespace App\Filament\Resources;


use App\Models\Article;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\ArticleResource\Pages;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $modelLabel = 'Berita';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Judul')
                ->required(),


            RichEditor::make('content')
                ->label('Konten')
                ->required()
                ->toolbarButtons([
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ]),

            FileUpload::make('image')
                ->label('Gambar')
                ->image()
                ->disk('cloudinary')
                ->directory('articles')
                ->getUploadedFileNameForStorageUsing(fn ($file) => (string) str()->uuid() . '.' . $file->getClientOriginalExtension())
                ->nullable(),



            TextInput::make('slug')
                ->label('Slug')
                ->disabled(),

            Select::make('category_id')
                ->label('Kategori')
                ->options(Category::pluck('name', 'id'))
                ->required(),

            Toggle::make('is_highlighted')
                ->label('Highlight Berita')
                ->inline(false)
                ->default(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->label('Judul')
                ->sortable()
                ->searchable(),

            TextColumn::make('category.name')
                ->label('Kategori')
                ->sortable()
                ->searchable(),

            ImageColumn::make('image')
                ->label('Gambar')
                ->sortable()
                ->disk('cloudinary'),

            IconColumn::make('is_highlighted')
                ->label('Highlighted')
                ->boolean(),

            TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime()
                ->sortable(),
        ])
        ->filters([
            Filter::make('is_highlighted')
                ->label('Highlight Only')
                ->query(fn (Builder $query) => $query->where('is_highlighted', true)),
        ])
        ->actions([
            DeleteAction::make(),
            EditAction::make(),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
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