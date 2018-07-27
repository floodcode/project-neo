<form method="POST" action="{{ $formAction }}">
    @csrf
    <div class="form-group">
        <label for="news-create-title">{{ __('label.title') }}</label>
        <input class="form-control" id="news-create-title" type="text" name="title" value="{{ $item->title ?? '' }}">
    </div>
    <div class="form-group">
        <label for="news-create-message">{{ __('label.message') }}</label>
        <textarea class="form-control" id="news-create-message" rows="5" name="message">{{ $item->message ?? '' }}</textarea>
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