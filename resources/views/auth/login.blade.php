@extends('layouts.guest')

<title>Login</title>

@section('body')

    <body class=" d-flex flex-column">
        <script src="template/dist/js/demo-theme.min.js?1692870487"></script>
        <div class="page page-center">
            <div class="container container-tight py-4">
                <div class="text-center mb-4">
                    <a href="/" class="navbar-brand navbar-brand-autodark">
                        <img src="template/static/logo.svg" width="110" height="32" alt="Tabler"
                            class="navbar-brand-image">
                        <p><strong>SECURESHOP_ID</strong></p>
                    </a>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Faça login na sua conta</h2>
                        <form method="POST" action="{{ route('login') }}" autocomplete="off" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="seuemail@email.com" autocomplete="off" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Senha</label>
                                <div class="input-group input-group-flat @error('password') is-invalid @enderror">
                                    <input id="password" name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" placeholder="Sua senha"
                                        autocomplete="off">
                                    <span id="mostrar_senha"
                                        class="input-group-text @error('password') is-invalid @enderror"
                                        style="cursor: pointer; border-color: #6b7280">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" id="senha_icon"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                        </form>

                    </div>
                    <div class="hr-text">OU</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col"><a href="{{ route('face.login') }}" class="btn w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-camera-selfie">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                        <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
                                        <path d="M15 11l.01 0" />
                                        <path d="M9 11l.01 0" />
                                    </svg>
                                    Login com face
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center text-secondary mt-3">
                    Não tem uma conta? <a href="{{ route('register') }}" tabindex="-1">Cadastre-se</a>
                </div>
            </div>
        </div>
        <!-- Libs JS -->
        <!-- Tabler Core -->
        <script src="template/dist/js/tabler.min.js?1692870487" defer></script>
        <script src="template/dist/js/demo.min.js?1692870487" defer></script>
        <script>
            const toggleButton = document.getElementById('mostrar_senha');
            const passwordInput = document.getElementById('password');
            const senhaIcon = document.getElementById('senha_icon');

            toggleButton.addEventListener('click', () => {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    senhaIcon.innerHTML =
                        `<path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                   <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                   <path d="M17.94 17.94a10 10 0 0 1 -11.88 0m-2.2 -2.2a10 10 0 0 1 0 -11.88m2.2 -2.2a10 10 0 0 1 11.88 0m2.2 2.2a10 10 0 0 1 0 11.88" />`;
                } else {
                    passwordInput.type = 'password';
                    senhaIcon.innerHTML =
                        `<path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                   <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                   <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />`;
                }
            });
        </script>
    </body>
@endsection

</html>
