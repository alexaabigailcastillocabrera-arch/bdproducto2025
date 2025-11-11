<?php

namespace App\Filament\Resources\UnidadmedidaResource\Pages;

use App\Filament\Resources\UnidadmedidaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnidadmedida extends EditRecord
{
    protected static string $resource = UnidadmedidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
