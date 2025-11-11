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
                Select::make('modelo_id')
                    ->label('Modelo')
                    ->relationship('modelo', 'descripcion_modelo')
                    ->searchable()
                    ->required(),

                Select::make('marca_id')
                    ->label('Marca')
                    ->relationship('marca', 'descripcion_marca')
                    ->searchable()
                    ->required(),

                Select::make('categoria_id')
                    ->label('Categoría')
                    ->relationship('categoria', 'descripcion_categorias')
                    ->searchable()
                    ->required(),

                Select::make('unidadmedida_id')
                    ->label('Unidad de Medida')
                    ->relationship('unidadmedida', 'descripcion_unidad')
                    ->searchable()
                    ->required(),

                Select::make('estado_id')
                    ->label('Estado')
                    ->relationship('estado', 'nombre')
                    ->searchable()
                    ->required(),

                // Campos propios
                TextInput::make('pnombre')
                    ->label('Nombre del Producto')
                    ->required()
                    ->maxLength(191),

                TextInput::make('pdescripcion')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(191),

                TextInput::make('preciocompra')
                    ->label('Precio de Compra')
                    ->numeric()
                    ->required(),

                TextInput::make('preciounitario')
                    ->label('Precio Unitario')
                    ->numeric()
                    ->required(),

                TextInput::make('cantidad_ingresada')
                    ->label('Cantidad Ingresada')
                    ->numeric()
                    ->required(),

                TextInput::make('stock')
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
                TextColumn::make('modelo.descripcion_modelo')->label('Modelo')->sortable()->searchable(),
                TextColumn::make('marca.descripcion_marca')->label('Marca')->sortable()->searchable(),
                TextColumn::make('categoria.descripcion_categorias')->label('Categoría')->sortable()->searchable(),
                TextColumn::make('unidadmedida.descripcion_unidad')->label('Unidad')->sortable()->searchable(),
                TextColumn::make('estado.nombre')->label('Estado')->sortable()->searchable(),

                // Campos propios
                TextColumn::make('pnombre')->label('Producto')->searchable(),
                TextColumn::make('pdescripcion')->label('Descripción')->limit(50),
                TextColumn::make('preciocompra')->label('Precio Compra')->sortable(),
                TextColumn::make('preciounitario')->label('Precio Unitario')->sortable(),
                TextColumn::make('cantidad_ingresada')->label('Cantidad')->sortable(),
                TextColumn::make('stock')->label('Stock')->sortable(),

                // Fechas
                TextColumn::make('created_at')->label('Creado')->dateTime()->sortable(),
                TextColumn::make('updated_at')->label('Actualizado')->dateTime()->sortable(),
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
