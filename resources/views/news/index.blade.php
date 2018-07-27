@extends('base')

@section('title', __('title.news'))

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('button.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('button.news') }}</li>
        </ol>
    </nav>

    @if (count($news))
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
    @else
        @role('poster')
            <div class="text-center">
                <a class="btn btn-primary" href="{{ route('news.create') }}">{{ __('Add New Post') }}</a>
            </div>
        @else
            <p class="text-center">{{ __('message.nothing-to-show') }}</p>
        @endrole
    @endif

@endsection