<div id="comments">
    @if (count($item->comments))
        <h3>{{ __('title.comments') }}</h3>
        @foreach ($item->comments as $comment)
            <div class="card mb-3">
                <div class="card-body clearfix p-3">
                    @if ($comment->hasAccess(auth()->user()))
                        <div class="float-right">
                            <button class="btn btn-sm btn-danger delete-comment" data-id="{{ $comment->id }}">
                                {{ __('button.delete-comment') }}
                            </button>
                        </div>
                    @endif

                    {!! nl2br(e($comment->message)) !!}

                    <p class="text-muted mb-0">
                        {{ __('label.author:') }}
                        <a href="{{ route('user.view', ['id' => $comment->user->id]) }}">{{ $comment->user->name }}</a>,
                        {{ __('label.added:') }}
                        {{ $comment->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        @endforeach
    @endif

    @role('user')
        <h3>{{ __('title.add-comment') }}</h3>

        <div class="form-group">
            <textarea id="comment-message" class="form-control" rows="5" name="message"></textarea>
        </div>

        <div class="form-group text-right">
            <button id="comment-create" data-id="{{ $item->id }}" class="btn btn-primary">{{ __('button.add-comment') }}</button>
        </div>
    @else
        <h5 class="text-center muted m-5">
            {!! sprintf(__('message.comments-guest-message'), route('login')) !!}
        </h5>
    @endrole
</div>

@include('news.components.comment-delete-popup')