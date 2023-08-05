@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">
        @if ($errors->any())
                @foreach ($errors->all() as $error )
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        Edit Posts
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="" class="btn btn-success">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <form action="{{ route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                 <div class="form-group">
                    <div>
                     <img style="width: 200px" src="{{asset('storage/images/'.$post->image) }}" alt="no image">
                    </div>
                    <label for="">Image</label>
                    <input name="image" type="file" class="form-control">
                 </div>

                  <div class="form-group">
                    <label for="">Title</label>
                    <input name="title" type="text" class="form-control" value="{{ $post->title }}">
                 </div>
                
                 <div class="form-group">
                    <label for="">Category</label>
                    <select name="category_id" id="" class="form-control">
                        <option value="">-Select-</option>
                        @foreach ($categories as $category)
                        <option {{$category->id == $post->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                 </div>
                 
                 <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" cols="30" rows="10">{{$post->description}}</textarea>
                 </div>

                   <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                 </div>
               </form>
            </div>
        </div>
    </div>
@endsection