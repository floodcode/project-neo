@extends('base')

@section('title', 'News')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news') }}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <h3>Add new post</h3>

    <form method="POST" action="{{ route('news.create') }}">
        @csrf
        <div class="form-group">
            <label for="news-create-description">Title</label>
            <input class="form-control" id="news-create-title" type="text" placeholder="Default input">
        </div>
        <div class="form-group">
            <label for="news-create-description">Description</label>
            <textarea class="form-control" id="news-create-description" rows="5"></textarea>
        </div>
        <div class="form-group text-right">
            <a href="{{ route('news') }}" class="btn">Cancel</a>
            <button type="submit" class="btn btn-primary">Add New Post</button>
        </div>
    </form>
@endsection