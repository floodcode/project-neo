@extends('main')

@section('title', $item->isTranslated() ? __('title.edit-post') : __('title.translate-post') )

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('button.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news') }}">{{ __('button.news') }}</a></li>
            @if ($item->category)
                <li class="breadcrumb-item"><a href="{{ route('news.category', ['slug' => $item->category->slug]) }}">{{ $item->category->l10nRelevant()->name }}</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ route('news.view', ['id' => $item->id]) }}">{{ $item->l10nRelevant()->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $item->isTranslated() ? __('button.edit') : __('button.translate') }}</li>
        </ol>
    </nav>

    <h3>{{ $item->isTranslated() ? __('title.edit-post') : __('title.translate-post') }}</h3>

    @include('news.components.editor', [
        'formAction' => route('news.edit', ['id' => $item->id]),
        'cancelRoute' => route('news.view', ['id' => $item->id]),
        'submitButtonText' => $item->isTranslated() ? __('button.edit-post') : __('button.translate-post'),
        'imageRequired' => false
    ])

@endsection