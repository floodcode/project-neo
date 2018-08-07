<h3>{{ __('title.add-comment') }}</h3>

<div class="form-group">
    <textarea id="comment-message" class="form-control" rows="5" name="message"></textarea>
</div>

<div class="form-group text-right">
    <button id="comment-create" data-id="{{ $item->id }}" class="btn btn-primary">{{ __('button.add-comment') }}</button>
</div>