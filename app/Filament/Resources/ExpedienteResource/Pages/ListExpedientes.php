<?php

namespace App\Filament\Resources\ExpedienteResource\Pages;

use App\Filament\Resources\ExpedienteResource;
use App\Models\Expediente\Estado;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListExpedientes extends ListRecords
{
    protected static string $resource = ExpedienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        // Obtener el ID del estado "FINALIZADO" en una sola consulta
        $estadoFinalizadoId = Estado::select('id')->where('estado', 'FINALIZADO')->value('id');
        return [
            // 'all' => Tab::make('Todos'),
            'en_progreso' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('estado_id','!=', $estadoFinalizadoId)),
            'finalizado' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('estado_id', $estadoFinalizadoId)),
        ];
    }
}
