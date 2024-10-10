<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Asunto: {{ $expediente->asunto ?? '-' }}</title>
</head>

<body>

    <div class="p-4 mx-auto">
        {{-- {/* Header */}
        <header class="flex justify-between items-center mb-2 pb-2 border-b text-wrap">
            <img src="http://nemby.gov.py/wp-content/uploads/2023/03/Logo-Escudo-de-Nemby.png"
                alt="Escudo Municipalidad de Ñemby" class="h-16" />

            <img src="http://nemby.gov.py/wp-content/uploads/2023/03/Logo-Administracion-Tomas-Olmedo.png"
                alt="Logo Municipalidad de Ñemby" class="h-16" />
            <div class="text-start ">
                <h2 class="text-sm">Generado el: <br>10/10/2024 17:24 Hs</h2>
                <p class="text-sm">Usuario: <br>Ronald Niz</p>                
            </div>

        </header> --}}
        {{-- @include('pdf.expediente.header') --}}
        {{-- {/* Título */} --}}
        <h1 class="text-2xl font-bold text-center my-4">Datos</h1>

        {{-- {/* Información del Responsable y Expediente */} --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="border p-4">
                <h3 class="font-bold text-center mb-2">Responsable</h3>
                <p><span class="font-semibold">Nombre:</span> {{ $responsable->nombre_completo ?? 'N/A' }}</p>
                <p><span class="font-semibold">CI:</span> {{ $responsable->ci ?? 'N/A' }}</p>
                <p><span class="font-semibold">Teléfono:</span> {{ $responsable->telefono ?? 'N/A' }}</p>
                <p><span class="font-semibold">Ciudad:</span> {{ $responsable->ciudad->ciudad ?? 'N/A' }}</p>
                <p><span class="font-semibold">Tipo Persona:</span> {{ $responsable->tipo_persona ?? 'N/A' }}</p>
            </div>
            <div class="border p-4">
                <h3 class="font-bold text-center mb-2">Expediente</h3>
                <p><span class="font-semibold">N° mesa de entrada:</span> {{ $expediente->n_mesa_entrada ?? 'N/A' }}</p>
                <p><span class="font-semibold">Estado:</span> {{ $expediente->estado->estado ?? 'N/A' }}</p>
                <p><span class="font-semibold">Dirección:</span> {{ $expediente->departamento->departamento ?? 'N/A' }}
                </p>
                <p><span class="font-semibold">Ingreso el:</span>
                    {{ $expediente->created_at->format('d-m-Y H:i') ?? 'N/A' }}</p>
                <p><span class="font-semibold">Actualizado el:</span>
                    {{ $expediente->updated_at->format('d-m-Y H:i') ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- {/* Comentarios */} --}}
        <div class="mb-4">
            <h3 class="font-bold text-center border-b pb-2 mb-2">Comentarios</h3>
            @forelse ($comentarios as $comentario)
                <div class="mb-4">
                    <p class="font-semibold">{{ $comentario->usuario->name ?? 'N/A' }}</p>
                    <p class="text-sm">{{ $comentario->comentario ?? 'N/A' }} - <span
                            class="text-xs text-gray-500">Comentado el:
                            {{ $comentario->created_at->format('d-m-Y H:i') }} Hs.</span></p>
                </div>
            @empty
                <p class="font-semibold">Sin datos...</p>
            @endforelse
        </div>

        {{-- {/* Archivos */} --}}
        <div class="mb-4">
            <h3 class="font-bold text-center border-b pb-2 mb-2">Archivos</h3>
            @forelse ($archivos as $archivo)
                <ul class="list-disc list-inside">
                    <li class="text-sm">{{ $archivo->nombre_original }} -
                        {{ $archivo->created_at->format('d-m-Y H:i') }} HS</li>
                </ul>
            @empty
                <h3 class="font-bold border-b pb-2 mb-2">Sin adjuntos...</h3>
            @endforelse

        </div>

        
    </div>


</body>

</html>
