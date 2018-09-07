@extends('main')

@section('title', __('title.users'))

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('button.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('button.users') }}</li>
        </ol>
    </nav>

    123
@endsection