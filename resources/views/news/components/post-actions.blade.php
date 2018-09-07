@if ($item->hasAccess(auth()->user()))
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('button.actions') }}
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('news.edit', ['id' => $item->id]) }}">
                {{ $item->isTranslated() ? __('button.edit') : __('button.translate')}}
            </a>
            <button class="dropdown-item delete-post" data-id="{{ $item->id }}">
                {{ __('button.delete') }}
            </button>
            @if ($item->isTranslated() && count($item->translations) > 1)
                <div class="dropdown-divider"></div>
                <button class="dropdown-item delete-post-translation" data-id="{{ $item->id }}">
                    {{ __('button.delete-translation') }}
                </button>
            @endif
        </div>
    </div>

@endif