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
            <img class="news-image float-left" src="/public/img/news/{{ $item->image }}" alt="">
        @endif
        {!! $item->message !!}
    </div>
    <p class="text-muted" title="{{ $item->created_at }}">
        {{ $item->created_at->diffForHumans() }}
    </p>
    <div>
        <h3>{{ __('title.comments') }}</h3>

        @if (count($item->comments))
            @foreach ($item->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body clearfix">
                        @if ($item->hasAccess(Auth::user()))
                            <div class="float-right">
                                <button class="btn btn-sm btn-danger delete-comment" data-id="{{ $comment->id }}">
                                    {{ __('button.delete-comment') }}
                                </button>
                            </div>
                        @endif
                        {{ $comment->message }}
                        <p class="text-muted mb-0">
                            {{ __('label.author:') }}
                            {{ $comment->user->name }} |
                            {{ __('label.added:') }}
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @endforeach
        @elseguest
            <h5 class="text-center muted m-5">
                {!! sprintf(__('message.comments-guest-message'), route('login')) !!}
            </h5>
        @else
            <h5 class="text-center muted m-5">
                {{ __('message.no-comments') }}
            </h5>
        @endif

        @role('user')
            @include('news.components.comment-form')
        @endrole
    </div>

    @include('news.components.delete-popup')
    @include('news.components.comment-delete-popup')
@endsection

@section('scripts')
    {!! includeScript('/js/module/news.js') !!}
@endsection