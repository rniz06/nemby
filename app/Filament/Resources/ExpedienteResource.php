<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpedienteResource\Pages;
use App\Filament\Resources\ExpedienteResource\RelationManagers;
use App\Models\Ciudadano;
use App\Models\Departamento;
use App\Models\Expediente\Estado;
use App\Models\Expediente\Expediente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Auth;

class ExpedienteResource extends Resource
{
    protected static ?string $model = Expediente::class;

    protected static ?string $navigationLabel = 'Expedientes';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    // Campo para añadir el asunto del expediente
                    TextInput::make('asunto')
                        ->label('Asunto:'),
                    // Campo para el numero de mesa de entrada
                    TextInput::make('n_mesa_entrada')
                        ->label('N° Mesa de entrada:'),
                    // Campo para seleccionar el estado del expediente
                    Select::make('estado_id')
                        ->label('Estado:')
                        ->options(Estado::all()->pluck('estado', 'id'))
                        ->searchable(),
                    // Campo para obtener el usuario autenticado                
                    Hidden::make('agregado_por')
                        ->default(Auth::id()),
                    // Campo para seleccionar el ciudadano responsable del expediente
                    Select::make('ciudadano_id')
                        ->label('Ciudadano:')
                        ->options(Ciudadano::all()->pluck('nombre_completo', 'id'))
                        ->searchable(),
                    // Campo para seleccionar la direccion del expediente
                    Select::make('departamento_id')
                        ->label('Dirección:')
                        ->options(Departamento::all()->pluck('departamento', 'id'))
                        ->searchable()
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Campo Asunto
                TextColumn::make('asunto')
                    ->label('Asuto:')
                    ->sortable(),
                // Campo para el numero de mesa de entrada
                TextColumn::make('n_mesa_entrada')
                    ->label('N° Mesa Entrada:')
                    ->sortable(),
                // Campo para el estado del expediente
                TextColumn::make('estado.estado')
                    ->label('Estado:')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                // Campo para mostrar el usuario que añadio el expediente
                TextColumn::make('agregadoPor.name')
                    ->label('Agregado por:')
                    ->sortable(),
                // Campo para mostrar el ciudadano al cual corresponde
                TextColumn::make('ciudadano.nombre_completo')
                    ->label('Ciudadano:')
                    ->sortable(),
                // Campo para mostrar la direccion actual del expediente
                TextColumn::make('departamento.departamento')
                    ->label('Dirección actual:')
                    ->badge()
                    ->color('gray')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpedientes::route('/'),
            'create' => Pages\CreateExpediente::route('/create'),
            'view' => Pages\ViewExpediente::route('/{record}'),
            'edit' => Pages\EditExpediente::route('/{record}/edit'),
        ];
    }
}
