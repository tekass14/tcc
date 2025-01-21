@extends('layouts.app')

<title>Cadastro de Categoria</title>

@section('body')

    <body class="d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <form class="card card-md" action="{{ route('categoria.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Criar nova Categoria</h2>

                        <!-- Nome -->
                        <div class="mb-3">
                            <label class="form-label required">Nome</label>
                            <input id="nome" name="nome" type="text"
                                class="form-control @error('nome') is-invalid @enderror" placeholder="Nome da Categoria"
                                value="{{ old('nome') }}">
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Botão de Submissão -->
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Criar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </body>
@endsection
