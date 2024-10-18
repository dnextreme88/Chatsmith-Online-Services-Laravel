<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TaskNames: string implements HasLabel
{
    case FOCAL = 'Focal';
    case LIVE_CHAT = 'Live Chat';
    case MEETING = 'Meeting';
    case PERSISTIQ = 'PersistIQ';
    case PLATE_IQ = 'Plate IQ';
    case SMART_ALTO = 'Smart Alto';
    case TRAINING = 'Training';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FOCAL => 'Focal',
            self::LIVE_CHAT => 'Live Chat',
            self::MEETING => 'Meeting',
            self::PERSISTIQ => 'PersistIQ',
            self::PLATE_IQ => 'Plate IQ',
            self::SMART_ALTO => 'Smart Alto',
            self::TRAINING => 'Training'
        };
    }
}
