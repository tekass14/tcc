@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" type="imagex/png" href="{{ asset('img/logo.ico') }}">
    <title>Face Recognition</title>
    <!-- CSS files -->
    <link href="{{ asset('template/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('template/dist/js/tabler.min.js') }}"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    <div class="page">
        <!-- Navbar -->
        <x-layout.navbar></x-layout.navbar>
        <!-- Navbar -->

        <div class="page-wrapper">
            <!-- Page header -->
            @hasSection('header')
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <div class="page-pretitle">Overview</div>
                                <h2 class="page-title text-gray-900">
                                    @yield('header')
                                </h2>
                            </div>
                            <div class="">
                                @if (session('success'))
                                    <div class="d-flex justify-content-center">
                                        <div id="Sucesso"
                                            class="alert alert-success alert-dismissible fade show session-alert w-25"
                                            role="alert" style="border: none">
                                            <div
                                                class="alert-heading d-flex justify-content-between align-items-center">
                                                <p class="mb-0">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
            <!-- Page header -->

            <!-- Page body -->
            <main>
                <div class="page my-auto mt-4">
                    <div class="container-xl">
                        <script type="text/javascript">
                            function fechaModal() {
                                const modal = document.getElementById("Sucesso");
                                if (modal) {
                                    modal.style.opacity = "0";
                                    setTimeout(() => {
                                        modal.style.display = "none";
                                    }, 500); // Aguarda a animação de opacidade terminar antes de ocultar
                                }
                            }

                            // Define o tempo de 3 segundos para ocultar automaticamente
                            window.onload = function() {
                                const modal = document.getElementById("Sucesso");
                                if (modal) {
                                    setTimeout(() => {
                                        fechaModal();
                                    }, 3000); // 3 segundos
                                }
                            };
                        </script>
                        @yield('body')
                    </div>
                </div>
            </main>
            <!-- Page body -->

        </div>
    </div>
</body>

<!-- Tabler Core -->
@livewireScripts

</html>
