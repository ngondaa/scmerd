<?php

namespace App\Filament\Resources\SubmissionResource\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ReviewersRelationManager extends RelationManager
{
    protected static string $relationship = 'reviewers';

    protected static ?string $title = 'Assigned reviewers';

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_reviewer')
                    ->label('Reviewer')
                    ->boolean(),
                TextColumn::make('pivot.assigned_at')
                    ->label('Assigned at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(
                        fn (Builder $query): Builder => $query->where('is_reviewer', true)
                    )
                    ->schema(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        DateTimePicker::make('assigned_at')
                            ->label('Assigned at')
                            ->default(now())
                            ->required(),
                    ]),
            ])
            ->recordActions([
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
