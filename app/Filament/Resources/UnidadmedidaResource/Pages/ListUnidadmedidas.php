<?php

namespace App\Filament\Resources\UnidadmedidaResource\Pages;

use App\Filament\Resources\UnidadmedidaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnidadmedidas extends ListRecords
{
    protected static string $resource = UnidadmedidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
