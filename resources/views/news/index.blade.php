@extends('default')

@section('title', __('title.news'))

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('button.home') }}</a></li>
            @if ($category)
                <li class="breadcrumb-item"><a href="{{ route('news') }}">{{ __('button.news') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->l10nRelevant()->name }}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{ __('button.news') }}</li>
            @endif
        </ol>
    </nav>

    @if (count($news))
        @foreach ($news as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md text-center text-md-left">
                            <h3>
                                <a href="{{ route('news.view', ['id' => $item->id]) }}">
                                    {{ $item->l10nRelevant()->title }}
                                </a>
                            </h3>
                        </div>
                        @include('news.components.post-actions')
                    </div>

                    <div class="card-text clearfix">
                        @if ($item->image)
                            <a href="{{ route('news.view', ['id' => $item->id]) }}">
                                <img class="news-image float-left"
                                     src="/public/img/news/{{ $item->image }}"
                                     title="{{ $item->l10nRelevant()->title }}"
                                     alt="{{ $item->l10nRelevant()->title }}">
                            </a>
                        @endif
                        <div class="news-content">
                            {!! Str::words($item->l10nRelevant()->message, 150, '') !!}
                            @if (Str::length($item->l10nRelevant()->message) > 150)
                                <a href="{{ route('news.view', ['id' => $item->id]) }}">{{ __('button.read-more') }}</a>
                            @endif
                        </div>
                    </div>

                    <p class="text-muted m-0">
                        {{ __('label.author:') }}
                        <a href="{{ route('user.view', ['id' => $item->user->id]) }}">{{ $item->user->name }}</a>,

                        @if ($item->category)
                            {{ __('label.category:') }}
                            <a href="{{ route('news.category', ['slug' => $item->category->slug]) }}">{{ $item->category->l10nRelevant()->name }}</a>,
                        @endif

                        {{ __('label.comments:') }}
                        <a href="{{ route('news.view', ['id' => $item->id]) }}#comments">{{ count($item->comments) }}</a>,

                        {{ __('label.added:') }}
                        {{ $item->created_at->diffForHumans() }}

                        @if (!$item->isTranslated())
                            <span class="badge badge-danger">{{ __('label.not-translated') }}</span>
                        @endif
                    </p>
                </div>
            </div>
        @endforeach

        @role('poster')
            <div class="text-center mb-3">
                <a class="btn btn-primary" href="{{ route('news.create') }}">{{ __('button.add-post') }}</a>
            </div>
        @endrole

        <div class="paginator">
            {{ $news->links() }}
        </div>
    @else
        @role('poster')
            <div class="text-center">
                <a class="btn btn-primary" href="{{ route('news.create') }}">{{ __('button.add-post') }}</a>
            </div>
        @else
            <p class="text-center">{{ __('message.nothing-to-show') }}</p>
        @endrole
    @endif

    @include('news.components.post-actions-popup')
@endsection

@section('scripts')
    {!! includeScript('/js/module/news.js') !!}
@endsection