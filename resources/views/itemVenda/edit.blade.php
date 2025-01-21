@extends('layouts.app')

<title>Cadastro de Produtos da Venda</title>

@section('body')

    <body class="d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <form class="card card-md" action="{{ route('itemVenda.edit', []) }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Cadastrar Produtos da Venda</h2>

                        <!-- Nome -->
                        <div class="mb-3">
                            <label class="form-label required">Produto</label>
                            <div class="input-group mb-2">
                                <select value="{{ $itemVenda->produto_id }}" name="produto" id="produto">
                                    @if ($produtos->isEmpty())
                                        <option value="" disabled>Não há produtos Cadastrados</option>
                                    @else
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input class="form-control" type="number"></input>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Cliente</label>
                            <select class="form-select @error('cliente')is-invalid @enderror" name="cliente" id="cliente">
                                @if ($clientes->isEmpty())
                                    <option value="" disabled>Não há Clientes Cadastrados</option>
                                @else
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Cliente</label>
                            <select class="form-select @error('cliente')is-invalid @enderror" name="cliente" id="cliente">
                                @if ($clientes->isEmpty())
                                    <option value="" disabled>Não há Clientes Cadastrados</option>
                                @else
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                    @endforeach
                                @endif
                            </select>
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
