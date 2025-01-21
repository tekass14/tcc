@extends('layouts.app')

<title>Cadastro de Cliente</title>

@section('body')

    <body class="d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <form class="card card-md" action="{{ route('cliente.update', [$cliente->id]) }}" method="POST"
                    autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Atualizar Cliente</h2>

                        <!-- Nome -->
                        <div class="mb-3">
                            <label class="form-label required">Nome</label>
                            <input id="nome" name="nome" type="text"
                                class="form-control @error('nome') is-invalid @enderror" placeholder="Nome da Categoria"
                                value="{{ $cliente->nome }}">
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CPF</label>
                            <input id="cpf" name="cpf" type="text" class="form-control"
                                placeholder="cpf da Categoria" value="{{ $cliente->cpf }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Endereço</label>
                            <input id="endereco" name="endereco" type="text" class="form-control"
                                placeholder="endereco da Categoria" value="{{ $cliente->endereco }}">
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
