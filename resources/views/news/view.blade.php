@extends('main')

@section('title', $item->l10nRelevant()->title)

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('button.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news') }}">{{ __('button.news') }}</a></li>
            @if ($item->category)
                <li class="breadcrumb-item"><a href="{{ route('news.category', ['slug' => $item->category->slug]) }}">{{ $item->category->l10nRelevant()->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $item->l10nRelevant()->title }}</li>
        </ol>
    </nav>

    <div class="clearfix">
        <div class="float-right">
            @include('news.components.post-actions')
        </div>
        <h3>
            {{ $item->l10nRelevant()->title }}
        </h3>
    </div>

    <div class="clearfix">
        @if ($item->image)
            <div class="text-center">
                <a href="/public/img/news/{{ $item->image }}">
                    <img class="news-image float-md-left"
                         src="/public/img/news/{{ $item->image }}"
                         title="{{ $item->l10nRelevant()->title }}"
                         alt="{{ $item->l10nRelevant()->title }}">
                </a>
            </div>
        @endif
        <div class="news-content">
            {!! $item->l10nRelevant()->message !!}
        </div>
    </div>

    <p class="text-muted">
        {{ __('label.author:') }}
        <a href="{{ route('user.view', ['id' => $item->user->id]) }}">{{ $item->user->name }}</a>,

        @if ($item->category)
            {{ __('label.category:') }}
            <a href="{{ route('news.category', ['slug' => $item->category->slug]) }}">{{ $item->category->l10nRelevant()->name }}</a>,
        @endif

        {{ __('label.added:') }}
        {{ $item->l10nRelevant()->created_at->diffForHumans() }}

        @if (!$item->isTranslated())
            <span class="badge badge-warning">{{ __('label.not-translated') }}</span>
        @endif
    </p>

    @include('news.components.comments')
    @include('news.components.post-actions-popup')
@endsection

@section('scripts')
    {!! includeScript('/js/module/news.js') !!}
@endsection