@extends('base')

@section('title', 'News')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news') }}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $item->title }}</li>
        </ol>
    </nav>

    <h3>
        {{ $item->title }}
    </h3>
    <p>
        {{ $item->description }}
    </p>
    <p class="text-muted" title="{{ $item->created_at }}">
        {{ $item->created_at->diffForHumans() }}
    </p>
@endsection