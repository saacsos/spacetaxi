@extends('layouts.master')

@section('content')
    <h1>{{ $post->title }}</h1>
    <div>
        Since {{ $post->created_at->diffForHumans() }}({{ $post->created_at }})
    </div>

    <div>
        {{ $post->detail }}
    </div>

    <hr>

    @can ('update', $post)

        <a class="btn btn-info" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit This Post</a>
        <hr>

        <form id="deleteForm" onsubmit="return confirm('Are you sure to delete this post?')"
              action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" type="submit">DELETE</button>

        </form>

    @endcan

    <h1>{{ $post->comments->count() }} comment(s)</h1>

    <form action="{{ route('posts.comment.store', ['post' => $post->id]) }}" method="POST">
        @csrf
        <div>
            <label for="comment_detail">
                @if ($post->comments->isEmpty())
                    Be the first to comment this post
                @else
                    Write your comment to this post
                @endif
            </label>
            <textarea name="detail" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary" type="submit">Comment this post</button>
    </form>

    @foreach ($post->comments->sortByDesc('id') as $comment)
        <div>
            [{{ $comment->created_at->diffForHumans() }}]
            {{ $comment->detail }}
        </div>
    @endforeach
@endsection

@section('script')

@endsection
