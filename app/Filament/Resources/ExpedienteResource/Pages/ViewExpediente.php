<?php

namespace App\Filament\Resources\ExpedienteResource\Pages;

use App\Filament\Resources\ExpedienteResource;
use App\Models\Departamento;
use App\Models\Expediente\Archivo;
use App\Models\Expediente\Comentario;
use App\Models\Expediente\Expediente;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Filament\Infolists\Components\Actions\Action as ActionInfolist;

class ViewExpediente extends ViewRecord
{
    protected static string $resource = ExpedienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),

            // Logica que crea un boton para abri un modal y realizar un comentario
            Action::make('Subir Archivo')
                ->color('gray')
                ->form([
                    FileUpload::make('archivo')
                        ->label('')
                        ->directory('expedientes/' . date('Y') . '/' . date('m') . '/' . date('d'))
                        ->storeFileNamesIn('nombre_archivo_original')
                        ->previewable(true)
                        ->maxSize(20480)
                        ->required(),
                    Textarea::make('descripcion')
                        ->label('Descripción: (*Opcional)')
                ])
                ->action(function (array $data, Expediente $record) {
                    $archivo = new Archivo();

                    // preparar los datos a inserta en la tabla
                    $nombreOriginal = $data['nombre_archivo_original'];
                    $nombre_generado = basename($data['archivo']);
                    $ruta = $data['archivo'];
                    $tipo = Storage::disk('public')->mimeType($data['archivo']);
                    $tamano = Storage::disk('public')->size($data['archivo']);
                    $descripcion = $data['descripcion'];
                    //
                    $archivo->nombre_original = $nombreOriginal;
                    $archivo->nombre_generado = $nombre_generado;
                    $archivo->ruta = $ruta;
                    $archivo->tipo = $tipo;
                    $archivo->tamano = $tamano;
                    $archivo->descripcion = $descripcion;
                    $archivo->usuario_id = Auth::id();
                    $archivo->expediente_id = $record->id;

                    $archivo->save();
                }),

            // Logica que crea un boton para abri un modal y realizar un comentario
            Action::make('comentar')
                ->color('gray')
                ->form([
                    Textarea::make('comentario')
                        ->label('')
                        ->required()
                ])
                ->action(function (array $data, Expediente $record) {
                    $comentario = new Comentario();

                    $comentario->comentario = $data['comentario'];
                    $comentario->usuario_id = Auth::id();
                    $comentario->expediente_id = $record->id;

                    $comentario->save();
                }),


            // Logica que crea un boton para derivar el expediente
            Action::make('derivar')
                ->color('gray')
                ->fillForm(fn(Expediente $record): array => [
                    'departamento_id' => $record->departamento_id,
                ])
                ->form([
                    Select::make('departamento_id')
                        ->label('Seleccionar Dirección')
                        ->options(Departamento::query()->pluck('departamento', 'id'))
                        ->required(),
                ])
                ->action(function (array $data, Expediente $record): void {
                    $record->departamento_id = $data['departamento_id'];
                    $record->save();
                }),

        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make(3)
                    ->schema([
                        RepeatableEntry::make('comentarios')
                            ->schema([
                                TextEntry::make('usuario.name')->label(''),
                                TextEntry::make('created_at')->label('')->dateTime(),
                                TextEntry::make('comentario')->label('')->columnSpan(2),
                            ])->columnSpan(2),

                        Section::make('Detalles del Expediente:')
                            ->icon('heroicon-o-folder')
                            // ->description('Prevent abuse by limiting the number of requests per period')
                            ->schema([
                                TextEntry::make('asunto')
                                    ->label('Asunto:'),
                                TextEntry::make('n_mesa_entrada')
                                    ->badge()
                                    ->color('success')
                                    ->label('N° Mesa de entrada:'),
                                TextEntry::make('ciudadano.nombre_completo')
                                    ->label('Responsable:'),
                                TextEntry::make('departamento.departamento')
                                    ->label('Dirección Actual:'),
                                RepeatableEntry::make('archivos')
                                    ->schema([
                                        TextEntry::make('nombre_original')->label('')
                                        
                                        ->url(fn ($record) => route('expediente.descargar.archivo', $record->id))
                                        ->badge()
                                        ->openUrlInNewTab()                                        
                                    ])->contained(false),
                            ])->columnSpan(1)
                    ])->columnSpanFull()
            ]);
    }
}
