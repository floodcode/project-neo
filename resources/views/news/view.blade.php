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
        @if ($item->canEdit(auth()->user()))
        <div class="col-md text-center text-md-right">
            <div class="mb-2">
                <a class="btn btn-sm btn-primary" href="{{ route('news.edit', ['id' => $item->id]) }}">
                    {{ __('button.edit-post') }}
                </a>
                <button class="btn btn-sm btn-danger delete-post" data-id="{{ $item->id }}">
                    {{ __('button.delete-post') }}
                </button>
            </div>
        </div>
        @endif
    </div>
    <div>{!! $item->message !!}</div>
    <p class="text-muted" title="{{ $item->created_at }}">
        {{ $item->created_at->diffForHumans() }}
    </p>

    @include('news.components.delete-popup')
@endsection

@section('scripts')
    {!! includeAsset('/js/module/news.js') !!}
@endsection