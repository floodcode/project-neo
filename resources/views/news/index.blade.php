@extends('base')

@section('title', 'News')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">News</li>
        </ol>
    </nav>

    @foreach ($news as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('news.view', ['id' => $item->id]) }}">{{ $item->title }}</a>
                </h4>

                <p class="card-text">
                    {{ $item->description }}
                </p>

                <p class="card-text text-muted" title="{{ $item->created_at }}">
                    {{ $item->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
    @endforeach

    {{ $news->links() }}
@endsection