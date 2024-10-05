<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Expediente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
        }
        .page-content {
            padding: 2cm;
        }
        @media print {
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body class="bg-white font-sans leading-normal tracking-normal">
    <div class="page-content">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-700">Reporte de Expediente</h1>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-600 mb-2">Información del Expediente</h2>
            <div class="bg-gray-100 rounded p-4">
                <p class="mb-2"><span class="font-semibold">Número de Expediente:</span> {{ $expediente->n_mesa_entrada }}</p>
                <p class="mb-2"><span class="font-semibold">Fecha de Creación:</span> {{ $expediente->created_at->format('d/m/Y') }}</p>
                <p><span class="font-semibold">Estado:</span> 
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $expediente->estado->estado === 'FINALIZADO' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $expediente->estado->estado }}
                    </span>
                </p>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-600 mb-2">Detalles del Expediente</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Concepto</th>
                            <th class="py-2 px-4 border-b text-left">Usuario</th>
                            <th class="py-2 px-4 border-b text-left">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach($expediente->comentarios as $comentario)
                        <tr class="border-b border-gray-200">
                            <td class="py-2 px-4">{{ $comentario->comentario }}</td>
                            <td class="py-2 px-4">{{ $comentario->usuario->name }}</td>
                            <td class="py-2 px-4">{{ $comentario->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-sm text-gray-500 text-center mt-8">
            <p>Generado el {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>