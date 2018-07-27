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
        <div class="col">
            <h3>{{ $item->title }}</h3>
        </div>
        <div class="col text-right">
            @if ($item->canEdit(auth()->user()))
                <a class="btn btn-sm btn-primary" href="{{ route('news.edit', ['id' => $item->id]) }}">
                    {{ __('button.edit-post') }}
                </a>
                <button class="btn btn-sm btn-danger delete-post" data-id="{{ $item->id }}">
                    {{ __('button.delete-post') }}
                </button>
            @endif
        </div>
    </div>
    <p>{{ $item->message }}</p>
    <p class="text-muted" title="{{ $item->created_at }}">
        {{ $item->created_at->diffForHumans() }}
    </p>

@endsection