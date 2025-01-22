@extends('layouts.app')

<title>Cadastro de Venda</title>

@section('body')

    <body class="d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <form class="card card-md" action="{{ route('venda.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Cadastrar nova Venda</h2>

                        <!-- Nome -->
                        <div class="mb-3">
                            <label class="form-label required">Responsável</label>
                            <select value="{{ auth()->user()->id }}"
                                class="form-select @error('responsavel')is-invalid @enderror" name="responsavel"
                                id="responsavel">
                                @if ($users->isEmpty())
                                    <option value="" disabled>Não há usuários cadastrados</option>
                                @else
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('responsavel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                            @error('cliente')
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
