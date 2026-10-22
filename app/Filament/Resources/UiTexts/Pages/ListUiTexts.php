<?php

namespace App\Filament\Resources\UiTexts\Pages;

use App\Filament\Resources\UiTexts\UiTextResource;
use Filament\Resources\Pages\ListRecords;

class ListUiTexts extends ListRecords
{
    protected static string $resource = UiTextResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
