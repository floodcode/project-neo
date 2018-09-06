@extends('admin')

@section('title', __('title.users'))

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('button.admin-panel') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('button.news') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('button.categories') }}</li>
        </ol>
    </nav>

    @if (count($categories))
        <table class="table table-striped">
            <thead>
            <tr>
                <th style="width: 1px;">{{ __('label.id') }}</th>
                <th>{{ __('label.name') }}</th>
                <th>{{ __('label.url') }}</th>
                <th class="text-right">{{ __('label.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->l10nRelevant()->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td class="text-right p-2">
                        <button type="button"
                                class="btn btn-primary btn-sm edit-category"
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->l10nRelevant()->name }}"
                                data-slug="{{ $category->slug }}">Edit</button>
                        <button type="button" data-id="{{ $category->id }}" class="btn btn-danger btn-sm delete-category">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif


    <div class="text-center create-category">
        <button class="btn btn-primary">{{ __('button.add-category') }}</button>
    </div>

    <div class="modal fade" id="delete-category-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('title.delete-category') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('message.delete-this-item?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('button.close') }}</button>
                    <button type="button" class="btn btn-danger" id="delete-category-confirm">{{ __('button.delete') }}</button>
                </div>
            </div>
        </div>
    </div>

    @include('admin.news.components.categories-editor', [
        'modalId' => 'create-category',
        'modalTitle' => __('title.create-category'),
        'modalConfirm' => __('button.create')
    ])

    @include('admin.news.components.categories-editor', [
        'modalId' => 'edit-category',
        'modalTitle' => __('title.edit-category'),
        'modalConfirm' => __('button.edit')
    ])
@endsection

@section('scripts')
    {!! includeScript('/js/module/admin.js') !!}
@endsection