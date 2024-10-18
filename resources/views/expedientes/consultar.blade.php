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
                <form action="{{ route('expediente.consultar')}}" method="POST"
                    class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
                    @csrf
                    <h4 class="">Busca un expediente</h4>
                    <div class="form-floating mb-3">
                        <input type="text" name="ci" class="form-control form-control-sm" id="floatingInput"
                            placeholder="Ej: 7462854" required>
                        <label for="floatingInput">N° de CI:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="n_mesa_entrada" class="form-control form-control-sm" id="floatingPassword"
                            placeholder="Ej: 00001" required>
                        <label for="floatingPassword">N° mesa de entrada:</label>
                    </div>
                    <button class="w-100 btn btn-sm btn-danger" type="submit">Buscar...</button>
                    <hr class="my-4">
                </form>
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