<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/dashboard">
                Face recognition
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url(template/static/avatars/avatar.png)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>
                            {{ Auth::user()->name }}
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item" @click.prevent="$root.submit();">
                            {{ __('Sair') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
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
                    @if (auth()->user()->face_id)
                        <li class="nav-item">
                            <a class="nav-link" href="/face/edit">
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
                                    Atualizar Face
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('face.delete', auth()->user()->face_id) }}">
                                <button type="submit" class="nav-link">
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
                                        Deletar Face
                                    </span>
                                </button>
                            </form>
                        </li>
                    @endif
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
