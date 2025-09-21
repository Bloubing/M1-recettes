@foreach ($comments as $comment)
    <x-comment :comment="$comment" type="answer" />
    @if ($comment->children->count() > 0)
        @include('recursive-comments', ['comments' => $comment->children])
    @endif
@endforeach
