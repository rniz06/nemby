<div wire:poll.2s>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @foreach ($comentarios as $comentario)
    <x-filament::section>
        <x-slot name="heading">
            {{$comentario->usuario->name}}
            
        </x-slot>

        {{-- Content --}}

        {{$comentario->comentario}}
    </x-filament::section>
    <br>
    @endforeach
    <x-filament::pagination :paginator="$comentarios" />
</div>
