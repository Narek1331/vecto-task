@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-center">
                <a href="/post/create" class="btn">Add New Post</a>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $num => $post )
                      <tr>
                        <th scope="row">{{ $post['id'] }}</th>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['content'] }}</td>
                        <td>{{ $post['created_at'] }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="/post/edit/{{ $post['id'] }}" class="btn">Edit</a>
                                <form action="{{ route('post.destroy', ['id' => $post['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn">Delete</button>
                                </form>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
