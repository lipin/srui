@extends('layouts.default')

@section('content')

<h1>{{ $post->title }}</h1>

<p class="article-meta">
    <i class="fa fa-user"></i> by <a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->username }}</a>

    @if ( $currentUser && ($currentUser->can("manage_contents") || $currentUser->id == $post->user_id) )
    <span style="padding:0 6px">•</span>
        <i class="fa fa-pencil-square-o"></i> <a href="{{ route('posts.edit', $post->id) }}">edit</a>
        <span style="padding:0 6px">•</span>
        <i class="fa fa-trash"></i> <a href="{{ route('posts.destroy', $post->id) }}" data-method="delete">delete</a>
    @endif
</p>

<p class="article-meta meta">
    <i class="fa fa-calendar"></i> <span class="timeago" data-toggle="tooltip" data-placement="bottom" title="{{ $post->created_at }}">{{ $post->created_at }}</span>  <span style="padding:0 6px">•</span>
    <i class="fa fa-book"></i> <a href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name }}</a> <span style="padding:0 6px">•</span>
    <i class="fa fa-tags"></i>
    @forelse ($post->tags as $tag)
        <a href="{{ route('tags.show', $tag->normalized) }}"><span class="label label-default">{{ $tag->name }}</span></a>
    @empty
        N/A
    @endforelse

</p>

<hr>

<div class="article-body">
    {{ $post->body }}
</div>

<h4 style="margin-top:50px; margin-bottom:10px;">
    <hr>
    Comments ( {{ $comments->getTotal() }} ):
</h4>

<div class="article-comment list-group">
    @forelse ($comments as $comment)
        <div class="list-group-item">
            <h5 class="list-group-item-heading"><a href="{{ route('users.show', $comment->user->id) }}">{{ $comment->user->display_name }}</a></h5>
            <div class="comment_body">
                {{ $comment->body }}
            </div>
        </div>
    @empty
        <div class="list-group-item" style="border:none;">
            There are nothing here!
        </div>
    @endforelse
</div>

@include('layouts.partials.errors')

<div class="comment-input">
    {{ Form::open(['route' => 'comments.store', 'method' => 'post']) }}
        <input type="hidden" name="post_id" value="{{ $post->id }}" />

        <div class="form-group">
            @if ($currentUser)
              {{ Form::textarea('body', null, ['class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => lang('Leave a comment?'),
                                                'style' => "overflow:hidden",
                                                'id' => 'reply_content']) }}
            @else
              {{ Form::textarea('body', null, ['class' => 'form-control', 'disabled' => 'disabled', 'rows' => 5, 'placeholder' => lang('User Login Required for commenting.')]) }}
            @endif
        </div>

        <div class="form-group status-post-submit">
            {{ Form::submit(lang('Comment'), ['class' => 'btn btn-primary' . ($currentUser ? '' : ' disabled'), 'id' => 'reply-create-submit']) }}
        </div>

    {{ Form::close() }}
</div>

@stop

@section('scripts')
    <script>
$(document).ready(function(){
    $('.timeago').tooltip();
});
    </script>
@stop