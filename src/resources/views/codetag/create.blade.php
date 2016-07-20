@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Create Categories</h3>

        <a href="{{ route('admin.tags.index') }}" class="btn btn-default">Back</a>

        {!! Form::open(['method'=>'POST', 'route'=>'admin.tags.store']) !!}

        <div class="form-group">
            {!! Form::label('name',"Name:") !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'autofocus'=>'autofocus']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('parent_id',"Parent:") !!}
            <select name="parent_id" class="form-control">
                <option value="0">None</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-block']) !!}
        </div>

        {!! Form::close() !!}
    </div>

@endsection