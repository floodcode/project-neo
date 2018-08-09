@extends('base')

@section('title', $user->name)

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('button.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{ __('button.users') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md text-center text-md-left">
            <h3>{{ $user->name }}</h3>
            <p><strong>{{ __('label.role:') }} </strong>{{ $user->roleName() }}</p>
        </div>
    </div>
@endsection