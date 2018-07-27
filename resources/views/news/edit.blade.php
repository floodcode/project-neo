@extends('base')

@section('title', __('title.edit-post'))

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('button.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news') }}">{{ __('button.news') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.view', ['id' => $item->id]) }}">{{ $item->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('button.edit') }}</li>
        </ol>
    </nav>

    <h3>{{ __('title.edit-post') }}</h3>

    @include('news.editor', [
        'formAction' => route('news.edit', ['id' => $item->id]),
        'cancelRoute' => route('news.view', ['id' => $item->id]),
        'submitButtonText' => __('button.edit-post')
    ])

@endsection