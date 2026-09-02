<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages\EditSubmission;
use App\Filament\Resources\SubmissionResource\Pages\ListSubmissions;
use App\Models\Submission;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string|\UnitEnum|null $navigationGroup = 'Admin';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('Submission details')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Author account')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('author')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('track')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\Select::make('status')
                            ->options([
                                'Under Initial Review' => 'Under Initial Review',
                                'Rebuttal Open' => 'Rebuttal Open',
                                'Rebuttal Submitted' => 'Rebuttal Submitted',
                                'Accepted' => 'Accepted',
                                'Rejected' => 'Rejected',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('stage')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('keywords')
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('submitted_at')
                            ->label('Submitted at'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Abstract content')
                    ->schema([
                        Forms\Components\Textarea::make('abstract')
                            ->required()
                            ->rows(12),
                        Forms\Components\Textarea::make('rebuttal')
                            ->rows(6)
                            ->label('Rebuttal'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('track')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Submitted by')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Accepted' => 'success',
                        'Rejected' => 'danger',
                        'Rebuttal Open', 'Rebuttal Submitted' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Under Initial Review' => 'Under Initial Review',
                        'Rebuttal Open' => 'Rebuttal Open',
                        'Rebuttal Submitted' => 'Rebuttal Submitted',
                        'Accepted' => 'Accepted',
                        'Rejected' => 'Rejected',
                    ]),
                Tables\Filters\SelectFilter::make('track')
                    ->options(
                        Submission::query()->select('track')->distinct()->pluck('track', 'track')->toArray()
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubmissions::route('/'),
            'edit' => EditSubmission::route('/{record}/edit'),
        ];
    }
}
