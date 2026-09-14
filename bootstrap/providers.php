<?php

use App\Providers\AppServiceProvider;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\Filament\PaymentReviewPanelProvider;
use App\Providers\FortifyServiceProvider;
use Filament\FilamentServiceProvider;

return [
    AppServiceProvider::class,
    AdminPanelProvider::class,
    PaymentReviewPanelProvider::class,
    FortifyServiceProvider::class,
    FilamentServiceProvider::class,
];
