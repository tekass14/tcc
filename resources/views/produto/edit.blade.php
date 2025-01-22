@extends('layouts.app')

<title>Cadastro de Produto</title>

@section('body')

    <body class="d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <form class="card card-md" action="{{ route('produto.update', [$produto->id]) }}" method="POST"
                    autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Editar Produto</h2>

                        <div class="mb-3">
                            <label class="form-label required">Categoria</label>
                            <select value="{{ $produto->categoria_id }}" class="form-select" name="categoria"
                                id="categoria">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                @endforeach
                            </select>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Nome</label>
                            <input value="{{ $produto->nome }}" id="nome" name="nome" type="text"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Nome do Produto"
                                value="{{ old('nome') }}">
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Marca</label>
                            <input value="{{ $produto->marca }}" id="marca" name="marca" type="text"
                                class="form-control" placeholder="Marca do Produto" value="{{ old('marca') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Modelo</label>
                            <input value="{{ $produto->modelo }}" id="modelo" name="modelo" type="text"
                                class="form-control" placeholder="Modelo do Produto" value="{{ old('modelo') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Valor</label>
                            <input value="{{ $produto->preco }}" id="valor" name="valor" type="number"
                                step=".01" class="form-control @error('name')is-invalid @enderror"
                                placeholder="Valor do Produto">
                            @error('valor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea value="{{ $produto->descricao }}" class="form-control" name="descricao" id="descricao" rows="6"
                                placeholder="Descrição..."></textarea>
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
