<div class="modal fade" id="delete-news-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('title.delete-post') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('message.delete-this-item?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('button.close') }}</button>
                <button type="button" class="btn btn-danger" id="delete-post-confirm">{{ __('button.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-news-translation-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('title.delete-post-translation') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('message.delete-this-translation?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('button.close') }}</button>
                <button type="button" class="btn btn-danger" id="delete-post-translation-confirm">{{ __('button.delete') }}</button>
            </div>
        </div>
    </div>
</div>