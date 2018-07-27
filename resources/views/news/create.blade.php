@extends('base')

@section('title', __('title.add-post'))

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('button.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news') }}">{{ __('button.news') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('button.create') }}</li>
        </ol>
    </nav>

    <h3>{{ __('title.add-post') }}</h3>

    @include('news.editor', [
        'formAction' => route('news.create'),
        'cancelRoute' => route('news'),
        'submitButtonText' => __('button.add-post')
    ])

@endsection