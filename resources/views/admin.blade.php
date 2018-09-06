@extends('default')

@section('main-navbar')
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin') }}">{{ __('label.admin-panel') }}</a>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbar-news" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('button.news') }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbar-news">
                            <a class="dropdown-item" href="{{ route('admin.news.categories') }}">{{ __('button.categories') }}</a>
                        </div>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-right">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">{{ __('button.logout') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection