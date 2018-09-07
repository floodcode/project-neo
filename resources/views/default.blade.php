@extends('base')

@section('main-navbar')
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('news') }}" id="navbar-news" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('button.news') }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbar-news">
                            <a class="dropdown-item" href="{{ route('news') }}">{{ __('button.all-news') }}</a>
                            @foreach ($envCategories ?? [] as $category)
                                <a class="dropdown-item" href="{{ route('news.category', ['slug' => $category->slug]) }}">{{ $category->l10nRelevant()->name }}</a>
                            @endforeach
                        </div>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-right">
                    @role('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin') }}">{{ __('button.admin-panel') }}</a>
                        </li>
                    @endrole
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
@endsection