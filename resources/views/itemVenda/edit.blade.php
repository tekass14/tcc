@extends('layouts.app')

<title>Cadastro de Produtos da Venda</title>

@section('body')

    <body class="d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <form class="card card-md" action="{{ route('itemVenda.update', [$itemVenda->id]) }}" method="POST"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Atualizar Produto da Venda</h2>

                        <div class="mb-3">
                            <label class="form-label required">Produto</label>
                            <div class="row g-2 align-items-center mb-2">
                                <div class="col-md-8">
                                    <select name="produto" class="form-select">
                                        @if ($produtos->isEmpty())
                                            <option value="" disabled>Não há produtos cadastrados</option>
                                        @else
                                            @foreach ($produtos as $produto)
                                                <option value="{{ $produto->id }}"
                                                    {{ $produto->id == $itemVenda->produto_id ? 'selected' : '' }}>
                                                    {{ $produto->nome }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input value="{{ $itemVenda->quantidade }}" type="number" name="quantidade"
                                        class="form-control" placeholder="Qtd">
                                </div>
                            </div>
                        </div>

                        <!-- Venda -->
                        <div class="mb-3">
                            <label class="form-label required">Venda</label>
                            <select class="form-select @error('venda')is-invalid @enderror" name="venda" id="venda">
                                <option value="{{ $itemVenda->venda_id }}">#{{ $itemVenda->venda_id }}</option>
                            </select>
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
