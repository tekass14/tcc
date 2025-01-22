@extends('layouts.app')

<title>Listagem de Produtos</title>

@section('header')
    Listagem de Produtos
@endsection

@section('body')
    <div class="page">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    <!-- Formulário de busca -->
                    <form method="GET" action="{{ route('produto.index') }}" class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Buscar por nome, marca ou modelo"
                                value="{{ request()->get('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.742a6.5 6.5 0 1 0-1.416 1.416l3.778 3.778a1 1 0 0 0 1.416-1.416l-3.778-3.778zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <td class="fw-bold" scope="col">#</td>
                                <td class="fw-bold" scope="col">Nome</td>
                                <td class="fw-bold" scope="col">Marca</td>
                                <td class="fw-bold" scope="col">Modelo</td>
                                <td class="fw-bold" scope="col">Valor</td>
                                <td class="fw-bold" scope="col">Descrição</td>
                                <td class="fw-bold" scope="col">Data de Cadastro</td>
                                <td class="fw-bold" scope="col">Ações</td>
                                <td class="fw-bold" scope="col"></td>
                                
                                <td class="fw-bold" scope="col">
                                    <a href="{{ route('produto.create') }}" class="btn btn-success"
                                        title="Adicionar Produto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 4a.5.5 0 0 1 .5.5V7.5H11.5a.5.5 0 0 1 0 1H8.5V11.5a.5.5 0 0 1-1 0V8.5H4.5a.5.5 0 0 1 0-1H7.5V4.5A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </thead>
                        @foreach ($produtos as $produto)
                            <tbody>
                                <tr>
                                    <td>{{ $produto->id }}</td>
                                    <td>{{ $produto->nome ?? 'Não há Dados' }}</td>
                                    <td>{{ $produto->marca ?? 'Não há Dados' }}</td>
                                    <td>{{ $produto->modelo ?? 'Não há Dados' }}</td>
                                    <td>R${{ $produto->preco ?? 'Não há Dados' }}</td>
                                    <td>{{ $produto->descricao ?? 'Não há Dados' }}</td>
                                    <td>{{ $produto->created_at ?? 'Não há Dados' }}</td>
                                    <td>
                                        <a href="{{ route('produto.edit', [$produto->id]) }}">
                                            <button class="btn border-0">
                                                Editar &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="#000000"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                    <path d="M13.5 6.5l4 4" />
                                                </svg>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                    <a href="{{ route('produto.delete', [$produto->id]) }}">
                                            <button class="btn border-0">
                                                Deletar &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="#ff0000"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-ban">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M5.7 5.7l12.6 12.6" />
                                                </svg>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="pagination">
                        {{ $produtos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
