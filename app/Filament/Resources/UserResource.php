<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Models\User;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Illuminate\Support\Facades\Hash;
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
                        Forms\Components\Toggle::make('is_admin')
                            ->label('Admin access')
                            ->helperText('Grant access to the Filament admin panel.'),
                        Forms\Components\TextInput::make('registration_package')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                            ->label('Password')
                            ->helperText('Set a password when creating or updating a user. Leave blank to keep existing password.'),
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
                        Forms\Components\Select::make('registration_status')
                            ->options(['unpaid' => 'Unpaid', 'pending' => 'Pending review', 'paid' => 'Paid', 'rejected' => 'Rejected'])
                            ->default('unpaid')
                            ->required(),
                        Forms\Components\FileUpload::make('payment_proof_path')
                            ->label('Payment proof')
                            ->disk('public')
                            ->directory('payment_proofs')
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/webp'])
                            ->openable()
                            ->downloadable(),
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
                Tables\Columns\TextColumn::make('registration_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success', 'pending' => 'warning', 'rejected' => 'danger', default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\IconColumn::make('payment_proof_path')
                    ->label('Proof')
                    ->boolean(fn ($record): bool => filled($record->payment_proof_path)),
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
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
