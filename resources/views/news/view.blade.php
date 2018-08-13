@extends('base')

@section('title', $item->title)

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('button.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news') }}">{{ __('button.news') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $item->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md text-center text-md-left">
            <h3>{{ $item->title }}</h3>
        </div>
        @if ($item->hasAccess(auth()->user()))
            <div class="col-md-4 text-center text-md-right">
                <div class="mb-2">
                    <a class="btn btn-sm btn-primary" href="{{ route('news.edit', ['id' => $item->id]) }}">
                        {{ __('button.edit') }}
                    </a>
                    <button class="btn btn-sm btn-danger delete-post" data-id="{{ $item->id }}">
                        {{ __('button.delete') }}
                    </button>
                </div>
            </div>
        @endif
    </div>
    <div class="clearfix">
        @if ($item->image)
            <a href="/public/img/news/{{ $item->image }}">
                <img class="news-image float-left"
                     src="/public/img/news/{{ $item->image }}"
                     title="{{ $item->title }}"
                     alt="{{ $item->title }}">
            </a>
        @endif
        {!! $item->message !!}
    </div>

    <p class="text-muted">
        {{ __('label.author:') }}
        <a href="{{ route('user.view', ['id' => $item->user->id]) }}">{{ $item->user->name }}</a>,
        {{ __('label.added:') }}
        {{ $item->created_at->diffForHumans() }}
    </p>

    @include('news.components.comments')
    @include('news.components.delete-popup')
@endsection

@section('scripts')
    {!! includeScript('/js/module/news.js') !!}
@endsection