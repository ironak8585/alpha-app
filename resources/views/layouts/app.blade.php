<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>

    <header>
        @include('components.nav')
    </header>

    <main>
        <section class="section pt-1 pb-1">
            <div class="is-hidden-mobile">
                @isset($breadcrumbs)
                    <x-breadcrumb :links="$breadcrumbs"></x-breadcrumb>
                    <div class="divider mt-0 mb-0"></div>
                @endisset
            </div>
        </section>

        <section class="section">
            {{ $content }}
        </section>

    </main>

    <footer class="footer pt-3 pb-3">
        <div class="content has-text-centered">
            <p>
                <strong>{{ env('APP_NAME') }}</strong>
                <br />
                All rights are reserved.
            </p>
        </div>
    </footer>

    <script type="application/javascript">
        $(document).ready(function() {
            init();
        });

    </script>

    @include('components.notifications')

</body>

</html>
