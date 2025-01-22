<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/dashboard" class="d-flex align-items-center">
                <img src="{{asset('img/logo.ico')}}" width="110" height="32" alt="Tabler" class="navbar-brand-image me-2">
                <p class="mb-0"><strong>FACE RECOGNITION</strong></p>
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <button href="" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ asset('template/static/avatars/avatar.png') }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>
                            {{ Auth::user()->name }}
                        </div>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                        @csrf
                    </form>
                    <a href="" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Sair') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="navbar-expand-md">
    <div class="navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Home
                            </span>
                        </a>
                    </li>
                    @if (empty(auth()->user()->face_id))
                        <li class="nav-item">
                            <a class="nav-link" href="/face/register">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-lego">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9.5 11l.01 0" />
                                        <path d="M14.5 11l.01 0" />
                                        <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
                                        <path
                                            d="M7 5h1v-2h8v2h1a3 3 0 0 1 3 3v9a3 3 0 0 1 -3 3v1h-10v-1a3 3 0 0 1 -3 -3v-9a3 3 0 0 1 3 -3" />
                                    </svg>

                                </span>
                                <span class="nav-link-title">
                                    Cadastrar Face
                                </span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-category">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 4h6v6h-6z" />
                                    <path d="M14 4h6v6h-6z" />
                                    <path d="M4 14h6v6h-6z" />
                                    <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Categoria
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{ route('categoria.create') }}">
                                    Cadastro
                                </a>
                                <a class="dropdown-item" href="{{ route('categoria.index') }}">
                                    Lista
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"></path>
                                    <path d="M12 12l8 -4.5"></path>
                                    <path d="M12 12l0 9"></path>
                                    <path d="M12 12l-8 -4.5"></path>
                                    <path d="M16 5.25l-8 4.5"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Produto
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{ route('produto.create') }}">
                                    Cadastro
                                </a>
                                <a class="dropdown-item" href="{{ route('produto.index') }}">
                                    Lista
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Cliente
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{ route('cliente.create') }}">
                                    Cadastro
                                </a>
                                <a class="dropdown-item" href="{{ route('cliente.index') }}">
                                    Lista
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-report-money">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path
                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                    <path d="M12 17v1m0 -8v1" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Venda
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{ route('venda.create') }}">
                                    Cadastro
                                </a>
                                <a class="dropdown-item" href="{{ route('venda.index') }}">
                                    Lista
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<script>
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.classList.add('active');
        });
        item.addEventListener('mouseleave', () => {
            item.classList.remove('active');
        });
    });

    const currentUrl = window.location.pathname;
    document.querySelectorAll('.nav-item a').forEach(link => {
        if (link.getAttribute('href') === currentUrl) {
            link.parentElement.classList.add('active');
        }
    });
</script>
