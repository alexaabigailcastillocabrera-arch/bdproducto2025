<?php
namespace App\Filament\Resources;
use App\Filament\Resources\ProductoResource\Pages;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Productos';
    protected static ?string $pluralLabel = 'Productos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Relaciones
                Forms\Components\Select::make('modelos_id')
                    ->label('Modelo')
                    ->relationship('modelo', 'nombre_modelo')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('marcas_id')
                    ->label('Marca')
                    ->relationship('marca', 'nombre_marca')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('categorias_id')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre_categorias')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('unidadmedidas_id')
                    ->label('Unidad de Medida')
                    ->relationship('unidadmedida', 'nombre_unidad')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('estados_id')
                    ->label('Estado')
                    ->relationship('estado', 'nombre')
                    ->required()
                    ->searchable()
                    ->preload(),

                // Campos propios
                Forms\Components\TextInput::make('pnombre')
                    ->label('Nombre del Producto')
                    ->required()
                    ->maxLength(191),

                Forms\Components\TextInput::make('pdescripcion')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(191),

                Forms\Components\TextInput::make('preciocompra')
                    ->label('Precio de Compra')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('preciounitario')
                    ->label('Precio Unitario')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('cantidad_ingresada')
                    ->label('Cantidad Ingresada')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('stock')
                    ->label('Stock Actual')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Relaciones
                Tables\Columns\TextColumn::make('modelo.nombre_modelo')
                ->label('Modelo')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('marca.nombre_marca')
                ->label('Marca')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('categoria.nombre_categorias')
                ->label('Categoría')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('unidadmedida.nombre_unidad')
                ->label('Unidad')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('estado.nombre')
                ->label('Estado')
                ->numeric()
                ->sortable(),

                // Campos propios
                Tables\Columns\TextColumn::make('pnombre')
                ->label('Producto')
                ->searchable(),
                Tables\Columns\TextColumn::make('pdescripcion')
                ->label('Descripción')
                ->limit(50),
                Tables\Columns\TextColumn::make('preciocompra')
                ->label('Precio Compra')
                ->money()
                ->sortable(),
                Tables\Columns\TextColumn::make('preciounitario')
                ->label('Precio Unitario')
                ->money()
                ->sortable(),
                Tables\Columns\TextColumn::make('cantidad_ingresada')
                ->label('Cantidad')
                ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                ->label('Stock')
                ->sortable(),

                // Fechas
                Tables\Columns\TextColumn::make('created_at')
                ->label('Creado')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->label('Actualizado')
                ->dateTime()
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
        return [
            // Si deseas agregar RelationManagers (por ejemplo, detalles o stock), los pones aquí
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
