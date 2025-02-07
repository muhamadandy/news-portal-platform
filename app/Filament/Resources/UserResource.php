<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Pengguna';

    protected static ?string $modelLabel = 'Pengguna';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Pengguna')
                ->required(),
                Forms\Components\TextInput::make('email')
                ->label('Alamat Email')
                ->email()
                ->required(),
                Forms\Components\TextInput::make('password')
                ->password() // Use the password method for password fields
                ->label('Kata Sandi')
                ->visible(fn ($record) => $record === null) // Only visible during creation
                ->dehydrateStateUsing(fn ($state) => bcrypt($state)) // Encrypt the password before saving
                ->required(fn ($record) => $record === null),
                Forms\Components\Select::make('usertype')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Pengguna')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('email')
                ->label('Alamat Email')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('usertype')
                ->label('Tipe User')
                ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Bergabung')
                ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}