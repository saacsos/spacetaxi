@extends('layouts.master')

@section('content')
    <h1>Edit Post</h1>

    <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
        @method('PUT')
        @csrf

        <div class="form-group">
            <label for="title">Title</label>

            <input type="text" class="form-control @error('title') is-invalid @enderror"
                   name="title" value="{{ old('title', $post->title) }}">
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="detail">Detail</label>

            <textarea name="detail" class="form-control @error('detail') is-invalid @enderror"
                      id="detail" cols="30" rows="10">{{ old('detail', $post->detail) }}</textarea>
            @error('detail')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit">Update Post</button>

    </form>
@endsection
