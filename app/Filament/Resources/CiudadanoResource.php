<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use App\Filament\Resources\CiudadanoResource\Pages;
use App\Filament\Resources\CiudadanoResource\RelationManagers;
use App\Models\Barrio;
use App\Models\Ciudad;
use App\Models\Ciudadano;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class CiudadanoResource extends Resource
{
    protected static ?string $model = Ciudadano::class;

    protected static ?string $navigationLabel = 'Ciudadanos';

    protected static ?string $navigationIcon = 'vaadin-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('nombre')
                        ->label('Nombre:')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                            $nombre = $get('nombre');
                            $apellido = $get('apellido');
                            $nombre_completo =  $nombre . ' ' . $apellido;

                            $set('nombre_completo', $nombre_completo);
                        })
                        ->maxLength(255),
                    Forms\Components\TextInput::make('apellido')
                        ->label('Apellido:')
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                            $nombre = $get('nombre');
                            $apellido = $get('apellido');
                            $nombre_completo =  $nombre . ' ' . $apellido;

                            $set('nombre_completo', $nombre_completo);
                        })
                        ->default(null),
                    Forms\Components\Hidden::make('nombre_completo'),
                    Forms\Components\TextInput::make('ci')
                        ->label('CI:')
                        ->required()
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('ruc')
                        ->label('Ruc:')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('telefono')
                        ->label('Teléfono:')
                        ->required()
                        ->tel()
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('email')
                        ->label('Email:')
                        ->email()
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('direccion_particular')
                        ->label('Dirección Particular')
                        ->maxLength(255)
                        ->default(null),
                    Select::make('tipo_persona')
                        ->label('Tipo de Persona')
                        ->required()
                        ->options([
                            'Persona Física' => 'Persona Física',
                            'Persona Jurídica' => 'Persona Jurídica',
                        ]),
                    Select::make('ciudad_id')
                        ->label('Ciudad:')
                        ->options(Ciudad::all()->pluck('ciudad', 'id'))
                        ->searchable()
                        ->live()
                        ->default(function() {
                            $nemby = Ciudad::where('ciudad', 'ÑEMBY')->first();
                            return $nemby ? $nemby->id : null;
                        })
                        ->afterStateUpdated(fn(callable $set) => $set('barrio_id', null))
                        ->required(),
                    Select::make('barrio_id')
                        ->label('Barrio:')
                        // ->options(Barrio::all()->pluck('barrio', 'id'))
                        ->options(function (callable $get) {
                            $ciudadId = $get('ciudad_id');
                            
                            if (!$ciudadId) {
                                return Collection::empty();
                            }
                            
                            return Barrio::where('ciudad_id', $ciudadId)
                                ->pluck('barrio', 'id');
                        })
                        ->searchable()
                        ->required()
                        ->disabled(fn (callable $get) => !$get('ciudad_id')),

                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_completo')
                    ->label('Nombre Completo:')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ci')
                    ->label('CI:')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ruc')
                    ->label('RUC:')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion_particular')
                    ->label('Dirección Particular')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo_persona')
                    ->label('Tipo de Persona'),
                Tables\Columns\TextColumn::make('barrio.barrio')
                    ->label('Barrio')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ciudad.ciudad')
                    ->label('Ciudad:')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado el:')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado el:')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListCiudadanos::route('/'),
            'create' => Pages\CreateCiudadano::route('/create'),
            'edit' => Pages\EditCiudadano::route('/{record}/edit'),
        ];
    }
}
