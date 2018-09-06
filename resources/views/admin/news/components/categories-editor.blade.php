<div class="modal fade" id="{{ $modalId }}-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="news-create-name">{{ __('label.name') }}</label>
                    <input required class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="news-create-slug">{{ __('label.slug') }}</label>
                    <input required class="form-control" type="text" name="slug">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('button.close') }}</button>
                <button type="button" class="btn btn-primary" id="{{ $modalId }}-confirm">{{ $modalConfirm }}</button>
            </div>
        </div>
    </div>
</div>