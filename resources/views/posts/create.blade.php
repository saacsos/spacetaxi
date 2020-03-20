@extends('layouts.master')

@section('content')
    <h1>Create New Post</h1>

    <form method="POST"
          action="{{ route('posts.store') }}">

        @csrf

        <div class="form-group">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <animation-input error="@error('title') {{ $message }} @enderror"
                name="title" label="Title" value="{{ old('title') }}"></animation-input>

        </div>

        <div class="form-group">
            <label for="detail">Detail</label>
            @error('detail')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <textarea name="detail" id="detail"
                      class="form-control @error('detail') is-invalid @enderror"
                      cols="30" rows="10">{{ old('detail') }}</textarea>

        </div>

        <button class="btn btn-primary" type="submit">Create New Post</button>
    </form>
@endsection
