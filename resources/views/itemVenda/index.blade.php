@extends('layouts.app')

<title>Listagem de Vendas</title>

@section('header')
    Listagem de Vendas
@endsection

@section('body')
    <div class="page">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="fw-bold" scope="col">#</td>
                                <td class="fw-bold" scope="col">Responsável</td>
                                <td class="fw-bold" scope="col">Cliente</td>
                                <td class="fw-bold" scope="col">Data de Cadastro</td>
                                <td class="fw-bold" scope="col">Ações</td>
                                <td class="fw-bold" scope="col">
                                    <a href="{{ route('venda.create') }}" class="btn btn-success" title="Cadastrar Venda">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 4a.5.5 0 0 1 .5.5V7.5H11.5a.5.5 0 0 1 0 1H8.5V11.5a.5.5 0 0 1-1 0V8.5H4.5a.5.5 0 0 1 0-1H7.5V4.5A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </thead>
                        @foreach ($vendas as $venda)
                            <tbody>
                                <tr>
                                    <td>{{ $venda->id }}</td>
                                    <td>
                                        @foreach ($users as $user)
                                            @if ($user->id == $venda->responsavel_id)
                                                {{ $user->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($clientes as $cliente)
                                            @if ($cliente->id == $venda->cliente_id)
                                                {{ $cliente->nome }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $venda->created_at }}</td>
                                    <td>
                                        <a href="{{ route('venda.edit', [$venda->id]) }}">
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
                                        <a href="{{ route('venda.delete', [$venda->id]) }}">
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
                                        <a href="{{ route('itemVenda.index', [$venda->id]) }}">
                                            <button class="btn border-0">
                                                Editar Produtos &nbsp; <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                    <path d="M13.5 6.5l4 4" />
                                                </svg>
                                            </button>
                                        </a>
                                        <a href="{{ route('venda.show', [$venda->id]) }}">
                                            <button class="btn border-0">
                                                Ver Produtos &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="24"
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
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="pagination">
                        {{ $itemVendas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
