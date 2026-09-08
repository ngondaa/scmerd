<?php

namespace App\Filament\Resources\SubmissionResource\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    protected static ?string $title = 'Reviews';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Reviewer')
                    ->relationship(
                        'user',
                        'name',
                        fn ($query) => $query->where('is_reviewer', true)
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->options([
                        'Under Initial Review' => 'Under Initial Review',
                        'Rebuttal Open' => 'Rebuttal Open',
                        'Rebuttal Submitted' => 'Rebuttal Submitted',
                        'Accepted' => 'Accepted',
                        'Rejected' => 'Rejected',
                    ])
                    ->nullable(),
                Textarea::make('comment')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('scores')
                    ->label('Scores (JSON)')
                    ->helperText('Optional JSON object, e.g. {"quality":8}')
                    ->formatStateUsing(function ($state): ?string {
                        if ($state === null || $state === '') {
                            return null;
                        }

                        return is_string($state)
                            ? $state
                            : json_encode($state, JSON_UNESCAPED_SLASHES);
                    })
                    ->dehydrateStateUsing(function (?string $state) {
                        if (! filled($state)) {
                            return null;
                        }

                        $decoded = json_decode($state, true);

                        return json_last_error() === JSON_ERROR_NONE ? $decoded : null;
                    }),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('user.name')
                    ->label('Reviewer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('comment')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
