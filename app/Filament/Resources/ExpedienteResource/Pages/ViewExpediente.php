<?php

namespace App\Filament\Resources\ExpedienteResource\Pages;

use App\Filament\Resources\ExpedienteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class ViewExpediente extends ViewRecord
{
    protected static string $resource = ExpedienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
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
                                    ->label('N° Mesa de entrada:'),
                                TextEntry::make('ciudadano.nombre_completo')
                                    ->label('Responsable:'),
                                TextEntry::make('departamento.departamento')
                                    ->label('Dirección Actual:'),
                            ])->columnSpan(1)
                    ])->columnSpanFull()
            ]);
    }
}
