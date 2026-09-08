<?php

namespace App\Filament\Resources\Reviews;

use App\Filament\Resources\Reviews\Pages\CreateReview;
use App\Filament\Resources\Reviews\Pages\EditReview;
use App\Filament\Resources\Reviews\Pages\ListReviews;
use App\Models\Review;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static string|UnitEnum|null $navigationGroup = 'Conference';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Review')
                    ->schema([
                        Select::make('submission_id')
                            ->label('Submission')
                            ->relationship('submission', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),
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
                            ->rows(6)
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
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('submission.title')
                    ->label('Submission')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                TextColumn::make('user.name')
                    ->label('Reviewer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('comment')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Under Initial Review' => 'Under Initial Review',
                        'Rebuttal Open' => 'Rebuttal Open',
                        'Rebuttal Submitted' => 'Rebuttal Submitted',
                        'Accepted' => 'Accepted',
                        'Rejected' => 'Rejected',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReviews::route('/'),
            'create' => CreateReview::route('/create'),
            'edit' => EditReview::route('/{record}/edit'),
        ];
    }
}
