<?php

namespace App\Livewire;

use App\Models\Expediente\Comentario as ExpedienteComentario;
use App\Models\Expediente\Expediente;
use Livewire\WithPagination;
use Livewire\Component;

class Comentario extends Component
{
    use WithPagination;
    
    public Expediente $record;

    public function render()
    {
        // $comentarios = ExpedienteComentario::
        //                 select('id', 'comentario', 'usuario_id', 'expediente_id')
        //                 ->with('usuario')
        //                 ->where('expediente_id', $this->record->id)
        //                 ->paginate(3);
        // return view('livewire.comentario', ['comentarios' => $comentarios]);

        // $comentarios = ExpedienteComentario::
        //                 select('id', 'comentario', 'usuario_id', 'expediente_id')
        //                 ->with('usuario')
        //                 ->where('expediente_id', $this->record->id)
        //                 ->paginate(3);
        return view('livewire.comentario', ['comentarios' => ExpedienteComentario::select('id', 'comentario', 'usuario_id', 'expediente_id')->with('usuario')->where('expediente_id', $this->record->id)->paginate(3)]);
    }
}
