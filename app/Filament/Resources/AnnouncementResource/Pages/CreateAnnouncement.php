<?php

namespace App\Filament\Resources\AnnouncementResource\Pages;

use App\Filament\Resources\AnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array {
        $data['user_id'] = auth()->id();
    
        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string {
        return 'Announcement created';
    }
}
