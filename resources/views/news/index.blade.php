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
                    <div class="row">
                        <div class="col">
                            <h3>
                                <a href="{{ route('news.view', ['id' => $item->id]) }}">{{ $item->title }}</a>
                            </h3>
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

                    <p class="card-text">
                        {{ $item->message }}
                    </p>

                    <p class="card-text text-muted" title="{{ $item->created_at }}">
                        {{ $item->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        @endforeach

        @role('poster')
        <div class="text-center mb-3">
            <a class="btn btn-primary" href="{{ route('news.create') }}">{{ __('button.add-post') }}</a>
        </div>
        @endrole

        {{ $news->links() }}
    @else
        @role('poster')
            <div class="text-center">
                <a class="btn btn-primary" href="{{ route('news.create') }}">{{ __('button.add-post') }}</a>
            </div>
        @else
            <p class="text-center">{{ __('message.nothing-to-show') }}</p>
        @endrole
    @endif

@endsection