@extends('layouts.app')

<title>Cadastro de Produto</title>

@section('body')

    <body class="d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <form class="card card-md" action="{{ route('produto.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Criar novo Produto</h2>

                        <div class="mb-3">
                            <label class="form-label required">Categoria</label>
                            <select class="form-select @error('categoria')is-invalid @enderror" name="categoria"
                                id="categoria">
                                @if ($categorias->isEmpty())
                                    <option value="" disabled>Não há categorias cadastradas</option>
                                @else
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('categoria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Nome</label>
                            <input id="nome" name="nome" type="text"
                                class="form-control @error('nome') is-invalid @enderror" placeholder="Nome do Produto"
                                value="{{ old('nome') }}">
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Marca</label>
                            <input id="marca" name="marca" type="text" class="form-control"
                                placeholder="Marca do Produto" value="{{ old('marca') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Modelo</label>
                            <input id="modelo" name="modelo" type="text" class="form-control"
                                placeholder="Modelo do Produto" value="{{ old('modelo') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Valor</label>
                            <input id="valor" name="valor" type="number" step=".01"
                                class="form-control @error('valor')is-invalid @enderror" placeholder="Valor do Produto"
                                value="{{ old('valor') }}">
                            @error('valor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao" id="descricao" rows="6" placeholder="Descrição..."></textarea>
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
