<form method="POST" action="{{ $formAction }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col-9">
                <label for="news-create-title">{{ __('label.title') }}</label>
                <input required class="form-control" id="news-create-title" type="text" name="title"
                       value="{{ old('title', $item->l10nRelevant()->title ?? '') }}">
            </div>
            <div class="col-3">
                <label for="news-create-category">{{ __('label.category') }}</label>
                <div>
                    <select class="selectpicker w-100" data-style="btn-default" id="news-create-category" name="category-id">
                        <option value="{{ \App\Models\Category::NO_CATEGORY }}">{{ __('label.no-category') }}</option>
                        @foreach($categories as $category)
                            <option
                                    value="{{ $category->id }}"
                                    {{ $item->category && $item->category->id == $category->id ? 'selected' : '' }}>
                                {{ $category->l10nRelevant()->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="news-create-message">{{ __('label.message') }}</label>
        <textarea required class="form-control" id="news-create-message" rows="10" name="message">
            {{ old('message', $item->l10nRelevant()->message ?? '')  }}
        </textarea>
    </div>
    <div class="form-group">
        <label for="news-create-image">{{ __('label.post-image') }}</label>
        <div class="custom-file">
            <input {{ $imageRequired ? 'required' : '' }} type="file" name="image" accept="image/png, image/jpeg" class="custom-file-input" id="news-create-image">
            <label id="news-create-image-label" class="custom-file-label" for="news-create-image">{{ __('label.choose-file') }}</label>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group text-right">
        <a href="{{ $cancelRoute }}" class="btn">{{ __('button.cancel') }}</a>
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</form>

@section('scripts')
    {!! includeScript('/ckeditor/ckeditor.js') !!}
    <script>
        CKEDITOR.replace('news-create-message');
    </script>

    {!! includeScript('/js/module/news.editor.js') !!}
@endsection