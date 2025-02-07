<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentReportResource\Pages;
use App\Filament\Resources\CommentReportResource\RelationManagers;
use App\Models\CommentReport;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    protected static ?string $navigationLabel = 'Komentar Dilaporkan';

    protected static ?string $modelLabel = 'Komentar Dilaporkan';

    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        // Count the number of reported comments
        $reportedCount = Report::count();


        // If there are reported comments, show the count as a badge in the sidebar
        return $reportedCount > 0 ? (string) $reportedCount : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('ID')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('comment.content')
                ->label('Komentar')
                ->wrap()
                ->searchable(),
            Tables\Columns\TextColumn::make('comment.user.name')
                ->label('Dibuat Oleh')
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Dilaporkan Pada')
                ->sortable()
                ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),

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
            'index' => Pages\ListCommentReports::route('/'),
            'create' => Pages\CreateCommentReport::route('/create'),
            'edit' => Pages\EditCommentReport::route('/{record}/edit'),
        ];
    }
}
