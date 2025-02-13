@extends('layouts.app')

<title>Editar Categoria</title>

@section('body')

    <body class="d-flex flex-column">
        <script src="template/dist/js/demo-theme.min.js?1692870487"></script>
        <div class="page page-center">
            <div class="container container-tight py-4">
                <form class="card card-md" action="{{ route('categoria.update', [$categoria->id]) }}" method="POST"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Atualizar Categoria</h2>

                        <!-- Nome -->
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input value="{{$categoria->nome}}" id="nome" name="nome" type="text"
                                class="form-control @error('nome') is-invalid @enderror" placeholder="Seu nome"
                                value="{{ $categoria->nome }}">
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Botão de Submissão -->
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Atualizar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </body>
@endsection
