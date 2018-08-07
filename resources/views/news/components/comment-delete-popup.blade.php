<div class="modal fade" id="delete-comment-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('title.delete-comment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('message.delete-this-item?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('button.close') }}</button>
                <button type="button" class="btn btn-danger" id="delete-comment-confirm">{{ __('button.delete') }}</button>
            </div>
        </div>
    </div>
</div>