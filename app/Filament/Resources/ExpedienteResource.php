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
use Filament\Infolists;
use Filament\Infolists\Infolist;

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
                        // Hace que el campo sea obligatorio en el formulario.
                        ->required()

                        // Función que se ejecuta cuando el componente ha sido "hidratado" con el estado actual (es decir, cuando los datos han sido cargados o establecidos).
                        ->afterStateHydrated(function (TextInput $component, $state) {
                            // Si el estado del campo está vacío, se ejecuta la siguiente lógica.
                            if (empty($state)) {
                                // Obtiene el año actual en formato de dos dígitos (ejemplo: '24' para el año 2024).
                                $year = date('y');

                                // Busca el último expediente registrado cuyo número de mesa de entrada comience con el año actual (formato '24-').
                                $lastExpediente = Expediente::where('n_mesa_entrada', 'like', $year . '-%')
                                    // Ordena los expedientes en orden descendente basándose en la parte numérica después del año (por ejemplo, '00001').
                                    ->orderByRaw('CAST(SUBSTRING(n_mesa_entrada, 4) AS UNSIGNED) DESC')
                                    // Obtiene el primer expediente de la lista, es decir, el más reciente.
                                    ->first();

                                // Si se encontró un expediente anterior...
                                if ($lastExpediente) {
                                    // Extrae la parte numérica del número de mesa de entrada y la convierte a un entero.
                                    $lastNumber = intval(substr($lastExpediente->n_mesa_entrada, 3));
                                    // Incrementa el número para generar el siguiente número de mesa de entrada.
                                    $newNumber = $lastNumber + 1;
                                } else {
                                    // Si no hay expedientes anteriores, establece el número como 1 (primer expediente del año).
                                    $newNumber = 1;
                                }

                                // Formatea el nuevo número de mesa de entrada en el formato '24-00001', añadiendo ceros a la izquierda si es necesario.
                                $newCode = $year . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

                                // Establece el estado del componente (es decir, el valor del campo) con el nuevo número de mesa de entrada generado.
                                $component->state($newCode);
                            }
                        })

                        // Indica que el valor del campo debe ser único, ignorando el registro actual si está siendo editado.
                        ->unique(ignoreRecord: true)

                        // Limita la longitud del campo a 8 caracteres.
                        ->length(8)

                        // Etiqueta visible del campo, que aparece en el formulario como "Número de Mesa de Entrada".
                        ->label('Número de Mesa de Entrada')

                        // Deshabilita el campo para que no sea editable directamente por el usuario.
                        ->disabled()

                        // Permite que el valor del campo se envíe cuando se envía el formulario, aunque esté deshabilitado.
                        ->dehydrated(true),

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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                Infolists\Components\Grid::make(3)
                ->schema([
                    Infolists\Components\Section::make('')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('comentarios')
                        ->schema([
                            Infolists\Components\Section::make(fn ($record) => $record->usuario->name . ' - ' . $record->created_at)
                            ->schema([
                                Infolists\Components\TextEntry::make('comentario')
                                ->label('')
                            ])
                        ])->contained(false)
                    ])
                    ->columnSpan(2),

                    Infolists\Components\Section::make([
                        Infolists\Components\TextEntry::make('asunto')
                            ->label('Asunto:'),
                        Infolists\Components\TextEntry::make('n_mesa_entrada')
                            ->label('N° Mesa de entrada:'),
                        Infolists\Components\TextEntry::make('ciudadano.nombre_completo')
                            ->label('Responsable:'),
                        Infolists\Components\TextEntry::make('departamento.departamento')
                            ->label('Dirección Actual:'),
                    ])->columnSpan(1),
                ])->columnSpanFull()
            ]);
    }
}