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
    <link href="template/dist/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="template/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="template/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="template/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
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

@livewireScripts
<!-- Tabler Core -->
<script src="template/dist/js/tabler.min.js?1692870487" defer></script>

</html>
