<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static string|\UnitEnum|null $navigationGroup = 'Admin';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('Profile')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_reviewer')
                            ->label('Reviewer access')
                            ->helperText('Grant access to the reviewer dashboard.'),
                        Forms\Components\TextInput::make('registration_package')
                            ->maxLength(50),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Registration details')
                    ->schema([
                        Forms\Components\Toggle::make('ecsa_accredited')
                            ->label('ECSA accredited'),
                        Forms\Components\TextInput::make('ecsa_number')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('student_id')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('certificate_name')
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('registration_paid_at')
                            ->label('Registration paid at'),
                        Forms\Components\TextInput::make('stripe_checkout_session_id')
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('registration_package')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_reviewer')
                    ->label('Reviewer')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('registration_paid_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_reviewer')
                    ->label('Reviewer status')
                    ->placeholder('All users')
                    ->trueLabel('Reviewers')
                    ->falseLabel('Non-reviewers'),
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
            'index' => ListUsers::route('/'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
