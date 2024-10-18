<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Mi Ñemby - Buscar expediente</title>
</head>

<body>
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img class="rounded-lg-3" src="{{ asset('/img/Logo-Escudo-de-Nemby.png') }}"
                    alt="Logo escudo de Ñemby" width="480">
            </div>
            <div class="col-lg-6 p-2 p-lg-5 pt-lg-3">
                <div class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
                    
                    <h4 class="">Resultado de la Busqueda:</h4>
                    <div class="form-group">
                        <label>Dirección actual:</label>
                        <div class="form-control">{{ $expediente->departamento->departamento }}</div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Estado actual:</label>
                        <div class="form-control">{{ $expediente->estado->estado }}</div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Ultima actualización:</label>
                        <div class="form-control">{{ date('d/m/Y h:m:s', strtotime($expediente->updated_at)) }}</div>
                    </div>
                    <br>
                    <a href="{{Route('expediente.consulta')}}" class="w-100 btn btn-sm btn-danger" type="submit">Volver...</a>
                    <hr class="my-4">
                </div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>