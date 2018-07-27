<form method="POST" action="{{ $formAction }}">
    @csrf
    <div class="form-group">
        <label for="news-create-title">{{ __('label.title') }}</label>
        <input class="form-control" id="news-create-title" type="text" value="{{ $item->title ?? '' }}">
    </div>
    <div class="form-group">
        <label for="news-create-description">{{ __('label.description') }}</label>
        <textarea class="form-control" id="news-create-description" rows="5">{{ $item->description ?? '' }}</textarea>
    </div>
    <div class="form-group text-right">
        <a href="{{ $cancelRoute }}" class="btn">{{ __('button.cancel') }}</a>
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</form>