<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">

        {!! includeStyle('/css/lib/bootstrap.min.css') !!}
        {!! includeStyle('/css/lib/bootstrap-select.min.css') !!}

        {!! includeStyle('/css/app.css') !!}

        @yield('styles')

        @if (app()->getLocale() === 'ach')
            <script type="text/javascript">
                var _jipt = [];
                _jipt.push(['project', 'project-neo']);
            </script>
            <script type="text/javascript" src="//cdn.crowdin.com/jipt/jipt.js"></script>
        @endif

        @yield('head-scripts')

        <title>{{ config('app.name') }} - @yield('title', 'News')</title>
    </head>

    <body>
        @yield('main-navbar')

        <main role="main">
            <div class="container mt-4">
                @yield('content')
            </div>
        </main>

        <footer class="container">
            <hr>
            <div class="row mb-3">
                <div class="col-md">
                    <p class="mt-2 mb-2">&copy; {{ config('app.name') }}</p>
                </div>
                <div class="col-md text-right">
                    <div class="dropup" id="language-select">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('title.language') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            @foreach(\App\Core\Locale::getHostMapping() as $code => $subdomain)
                                <button class="dropdown-item{{ app()->getLocale() == $code ? ' active' : '' }}"
                                        data-subdomain="{{ $subdomain == \App\Core\Locale::DEFAULT_LOCALE ? '' : $subdomain }}">
                                    <span class="lang-flag lang-flag-{{ $subdomain }}"></span>
                                    {{ __('title.language-name.' . $code) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        {!! includeScript('/js/lib/jquery.min.js') !!}
        {!! includeScript('/js/lib/popper.min.js') !!}
        {!! includeScript('/js/lib/bootstrap.min.js') !!}
        {!! includeScript('/js/lib/bootstrap-select.min.js') !!}
        {!! includeScript('/js/lib/moment.min.js') !!}

        {!! includeScript('/js/app.js') !!}

        @include('components.init')

        {!! includeScript('/js/bindings.js') !!}

        @yield('scripts')
    </body>
</html>
