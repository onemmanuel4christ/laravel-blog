@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">
            <div class="card">
            <div class="card-header">
                All Posts
                <a href="" class="btn btn-success">Create</a>
                <a href="" class="btn btn-warning">Trashed</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col" style="width: 5%">#</th>
                        <th scope="col" style="width: 10%">Image</th>
                        <th scope="col" style="width: 20%">Title</th>
                        <th scope="col" style="width: 35%">Description</th>
                        <th scope="col" style="width: 10%">Category</th>
                        <th scope="col" style="width: 10%">Published Date</th>
                        <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>
                            <img src="https://picsum.photos/200 " alt="" width="80px">
                        </td>
                        <td>Lorem ipsum dolor sit amet consectetur.</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi autem expedita tenetur libero magnam, maiores quod illo dicta culpa recusandae reprehenderit consequuntur laboriosam sint placeat commodi qui,</td>
                        <td>News</td>
                        <td>29-7-23</td>
                        <td>
                            <a href="" class="btn-sm btn-primary">Edit</a>
                            <a href="" class="btn-sm btn-danger">Delete</a>
                        </td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection