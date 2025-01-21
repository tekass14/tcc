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
        <div class="page-wrapper">

            <!-- Page body -->
            <main>
                <div class="page-body">
                    <div class="container-xl">
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
