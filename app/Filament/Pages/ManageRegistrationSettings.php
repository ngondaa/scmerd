<?php

namespace App\Filament\Pages;

use App\Models\AppSetting;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\HtmlString;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class ManageRegistrationSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static string|UnitEnum|null $navigationGroup = 'Registration';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Registration settings';

    protected static ?string $title = 'Registration settings';

    protected string $view = 'filament.pages.manage-registration-settings';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $payment = config('registration.payment', []);

        $this->form->fill([
            'registration_open' => (bool) AppSetting::get('registration_open', '1'),
            'bank_name' => $payment['bank_name'] ?? null,
            'account_name' => $payment['account_name'] ?? null,
            'account_number' => $payment['account_number'] ?? null,
            'branch_name' => $payment['branch_name'] ?? null,
            'branch_code' => $payment['branch_code'] ?? null,
            'reference_prefix' => $payment['reference_prefix'] ?? null,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        $pendingCount = User::query()->needsPaymentReview()->count();
        $packages = collect(config('registration.packages', []))
            ->map(fn (array $package, string $key) => sprintf(
                '%s — %s (%s)',
                $package['name'] ?? ucfirst($key),
                $package['display_price'] ?? '',
                $package['description'] ?? ''
            ))
            ->implode("\n");

        return $schema
            ->components([
                Form::make([
                    Section::make('Registration availability')
                        ->description('Controls whether authors can upload proof of payment.')
                        ->schema([
                            Toggle::make('registration_open')
                                ->label('Registration open')
                                ->helperText('When closed, authors cannot submit payment proofs.'),
                            TextEntry::make('pending_proofs')
                                ->label('Pending payment proofs')
                                ->state($pendingCount.' awaiting review — use Users → filter “Pending payment proofs”.'),
                        ]),
                    Section::make('Packages (read-only)')
                        ->description('Package prices are defined in config/registration.php.')
                        ->schema([
                            TextEntry::make('packages')
                                ->label('Configured packages')
                                ->state(new HtmlString(
                                    $packages !== ''
                                        ? nl2br(e($packages))
                                        : 'No packages configured.'
                                )),
                        ]),
                    Section::make('Bank details (read-only)')
                        ->description('Shown to authors on the proof-of-payment page. Edit config/registration.php to change.')
                        ->schema([
                            TextEntry::make('bank_name')->label('Bank')->state(fn (): ?string => $this->data['bank_name'] ?? null),
                            TextEntry::make('account_name')->label('Account name')->state(fn (): ?string => $this->data['account_name'] ?? null),
                            TextEntry::make('account_number')->label('Account number')->state(fn (): ?string => $this->data['account_number'] ?? null),
                            TextEntry::make('branch_name')->label('Branch')->state(fn (): ?string => $this->data['branch_name'] ?? null),
                            TextEntry::make('branch_code')->label('Branch code')->state(fn (): ?string => $this->data['branch_code'] ?? null),
                            TextEntry::make('reference_prefix')->label('Reference prefix')->state(fn (): ?string => $this->data['reference_prefix'] ?? null),
                        ])
                        ->columns(2),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save settings')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        AppSetting::set('registration_open', ! empty($state['registration_open']) ? '1' : '0');

        Notification::make()
            ->title('Registration settings saved')
            ->success()
            ->send();
    }
}
