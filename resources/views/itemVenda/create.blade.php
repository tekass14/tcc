@extends('layouts.app')

<title>Cadastro de Produtos da Venda</title>

@section('body')

    <body class="d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <form class="card card-md" action="{{ route('itemVenda.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Cadastrar Produtos da Venda</h2>

                        <!-- Produto e Quantidade -->
                        <div class="mb-3">
                            <label class="form-label required">Produtos e Quantidades</label>
                            <div id="product-fields">
                                <div class="row g-2 align-items-center mb-2">
                                    <div class="col-md-8">
                                        <select name="produtos[]" class="form-select">
                                            @if ($produtos->isEmpty())
                                                <option value="" disabled>Não há produtos cadastrados</option>
                                            @else
                                                @foreach ($produtos as $produto)
                                                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="quantidades[]" class="form-control" placeholder="Qtd">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary w-100" id="add-product">
                                Adicionar Outro Produto
                            </button>
                        </div>

                        <!-- Venda -->
                        <div class="mb-3">
                            <label class="form-label required">Venda</label>
                            <select class="form-select @error('venda')is-invalid @enderror" name="venda" id="venda">
                                <option value="{{ $idVenda }}">#{{ $idVenda }}</option>
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

        <!-- JavaScript -->
        <script>
            document.getElementById('add-product').addEventListener('click', function() {
                const productFields = document.getElementById('product-fields');

                // Cria uma nova linha de produto e quantidade
                const newRow = document.createElement('div');
                newRow.classList.add('row', 'g-2', 'align-items-center', 'mb-2');

                // Campo de produto
                const productCol = document.createElement('div');
                productCol.classList.add('col-md-8');
                productCol.innerHTML = `
                    <select name="produtos[]" class="form-select">
                        @if ($produtos->isEmpty())
                            <option value="" disabled>Não há produtos cadastrados</option>
                        @else
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                            @endforeach
                        @endif
                    </select>
                `;

                // Campo de quantidade
                const quantityCol = document.createElement('div');
                quantityCol.classList.add('col-md-4');
                quantityCol.innerHTML = `
                    <input type="number" name="quantidades[]" class="form-control" placeholder="Qtd">
                `;

                // Adiciona as colunas à linha
                newRow.appendChild(productCol);
                newRow.appendChild(quantityCol);

                // Adiciona a nova linha ao container
                productFields.appendChild(newRow);
            });
        </script>
    </body>
@endsection
