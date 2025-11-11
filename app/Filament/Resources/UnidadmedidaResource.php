<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnidadmedidaResource\Pages;
use App\Models\Unidadmedida;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class UnidadmedidaResource extends Resource
{
    protected static ?string $model = Unidadmedida::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale'; // Más representativo
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)->schema([
                    TextInput::make('nombre_unidad')
                        ->label('Nombre de la Unidad')
                        ->required()
                        ->maxLength(50),

                    TextInput::make('descripcion_unidad')
                        ->label('Descripción')
                        ->maxLength(255),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_unidad')
                    ->label('Unidad de Medida')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('descripcion_unidad')
                    ->label('Descripción')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Creado el')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Actualizado el')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnidadmedidas::route('/'),
            'create' => Pages\CreateUnidadmedida::route('/create'),
            'edit' => Pages\EditUnidadmedida::route('/{record}/edit'),
        ];
    }
}
