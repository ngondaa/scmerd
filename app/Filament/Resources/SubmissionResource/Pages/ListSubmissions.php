<?php

namespace App\Filament\Resources\SubmissionResource\Pages;

use App\Filament\Resources\SubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubmissions extends ListRecords
{
    protected static string $resource = SubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('exportAcceptedAbstracts')
                ->label('Export accepted abstracts PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->url(route('admin.exports.accepted-abstracts')),
            Actions\Action::make('acceptedAuthorsCampaign')
                ->label('Email accepted abstract authors')
                ->icon('heroicon-o-paper-airplane')
                ->url(route('admin.accepted-authors-campaign.preview')),
            Actions\CreateAction::make(),
        ];
    }
}
