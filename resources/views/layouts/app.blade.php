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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
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
                        @yield('body')
                    </div>
                </div>
            </main>
            <!-- Page body -->

        </div>
    </div>
</body>

@livewireScripts

<!-- Tabler Core -->
<script src="template/dist/js/tabler.min.js" defer></script>

</html>
