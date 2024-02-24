@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Post</h1>
    <form method="POST" action="/post">
        @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ $post['title'] }}">
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" rows="5" placeholder="Enter content" name="content" value="{{ $post['content'] }}">{{ $post['content'] }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection
