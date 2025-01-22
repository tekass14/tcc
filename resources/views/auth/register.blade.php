@extends('layouts.guest')

<title>Cadastro</title>

@section('body')

    <body class="d-flex flex-column">
        <script src="template/dist/js/demo-theme.min.js?1692870487"></script>
        <div class="page page-center">
            <div class="container container-tight py-4">
                <div class="text-center mb-4">
                    <a href="." class="navbar-brand navbar-brand-autodark">
                        <img src="template/static/logo.svg" width="110" height="32" alt="Tabler"
                            class="navbar-brand-image">
                        <p><strong>SECURESHOP_ID</strong></p>
                    </a>
                </div>
                <form class="card card-md" action="{{ route('register') }}" method="POST" autocomplete="off" novalidate>
                    @csrf
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Criar nova conta</h2>

                        <!-- Nome -->
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input id="name" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Seu nome"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input id="email" name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="seuemail@email.com"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Senha -->
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input id="password" name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Sua senha"
                                autocomplete="off">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar Senha -->
                        <div class="mb-3">
                            <label class="form-label">Confirmar senha</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="form-control" placeholder="Sua senha" autocomplete="off">
                        </div>

                        <!-- Botão de Submissão -->
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Criar conta</button>
                        </div>
                    </div>
                </form>

                <div class="text-center text-secondary mt-3">
                    Já tem uma conta? <a href="{{ route('login') }}" tabindex="-1">Login</a>
                </div>
            </div>
        </div>

        <!-- Libs JS -->
        <!-- Tabler Core -->
        <script src="template/dist/js/tabler.min.js?1692870487" defer></script>
        <script src="template/dist/js/demo.min.js?1692870487" defer></script>
    </body>
@endsection
