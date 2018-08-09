<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! includeExternalStyle('https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css') !!}
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
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbar-main"
                        aria-controls="navbar-main"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar-main">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('button.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news') }}">{{ __('button.news') }}</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav navbar-right">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('button.login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('button.register') }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">{{ __('button.logout') }}</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main role="main">
            <div class="container mt-4">
                @yield('content')
            </div>
        </main>

        <footer class="container">
            <hr>
            <p>&copy; {{ config('app.name') }}</p>
        </footer>

        {!! includeExternalScript('https://code.jquery.com/jquery-3.3.1.min.js') !!}
        {!! includeExternalScript('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js') !!}
        {!! includeExternalScript('https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js') !!}

        {!! includeScript('/js/app.js') !!}
        @yield('scripts')
    </body>
</html>
