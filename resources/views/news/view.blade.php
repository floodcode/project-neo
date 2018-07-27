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

    <h3>{{ $item->title }}</h3>
    <p>{{ $item->description }}</p>
    <p class="text-muted" title="{{ $item->created_at }}">
        {{ $item->created_at->diffForHumans() }}
    </p>
@endsection