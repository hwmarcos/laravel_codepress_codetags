@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>Tags</h3>

        <a href="{{ route('admin.tags.create') }}" class="btn btn-default">Create tag</a>

        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('admin.tags.edit', ['id'=>$tag->id]) }}">Edit</a> |
                        <a href="{{ route('admin.tags.delete', ['id'=>$tag->id]) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection