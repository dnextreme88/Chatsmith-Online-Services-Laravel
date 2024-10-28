<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ChatAccountTools: string implements HasLabel
{
    case LIVE_CHAT = 'Live Chat';
    case PERSISTIQ = 'PersistIQ';
    case SMART_ALTO = 'Smart Alto';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::LIVE_CHAT => 'Live Chat',
            self::PERSISTIQ => 'PersistIQ',
            self::SMART_ALTO => 'Smart Alto'
        };
    }
}
