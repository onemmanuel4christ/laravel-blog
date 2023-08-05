@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">
            <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                           Trashed Posts
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="{{ route('posts.create')}}" class="btn btn-success">Create</a>
                        <a href="" class="btn btn-warning">Trashed</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col" style="width: 5%">#</th>
                        <th scope="col" style="width: 7%">Image</th>
                        <th scope="col" style="width: 20%">Title</th>
                        <th scope="col" style="width: 30%">Description</th>
                        <th scope="col" style="width: 10%">Category</th>
                        <th scope="col" style="width: 10%">Published Date</th>
                        <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post )
                            <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>
                                <img src="{{ asset('storage/images/'.$post->image)  }}" alt="no pic" width="80px" >
                            </td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->description}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>{{date('d-m-Y', strtotime($post->created_at)) }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('posts.restore', $post->id)}}" class="btn-sm btn-success">Restore</a>

                                <form action="{{route('posts.delete', $post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-sm btn-danger">Delete Permanent</button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection