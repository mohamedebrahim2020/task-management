<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
			->schema([
				Toggle::make('role')
					->label('Is Admin')
					->helperText('Enable if this user is an admin'),
			]);
    }

    public static function table(Table $table): Table
    {
        return $table
			->columns([
				TextColumn::make('name')->searchable()->sortable(),
				TextColumn::make('email')->searchable()->sortable(),

				TextColumn::make('role')
					->label('Role')
					->badge()
					->formatStateUsing(fn ($state) => $state == 'admin' ?  'Admin' : 'User')
					->color(fn ($state) => $state == 'admin' ? 'success' : 'gray'),
			])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
