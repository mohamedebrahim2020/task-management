<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
			->schema([
				TextInput::make('title')->required()->maxLength(255),
				Textarea::make('description')->rows(4),
				DateTimePicker::make('due_date')
					->label('Due Date')
					->required(false),
				Toggle::make('is_completed')->label('Completed'),
				Select::make('user_id')
					->label('task Owner')
					->relationship('user', 'name')
					->searchable()
					->preload(),
			]);
    }

    public static function table(Table $table): Table
    {
		return $table
			->columns([
				TextColumn::make('title')->sortable()->searchable(),
				TextColumn::make('description')->sortable(),
				TextColumn::make('due_date')->label('Due Date')
					->since(),
				TextColumn::make('user.name')->label('Assigned To')->sortable(),
				IconColumn::make('is_completed')
					->boolean()
					->label('Done'),
				TextColumn::make('created_at')
					->dateTime('M d, Y')
					->label('Created'),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
