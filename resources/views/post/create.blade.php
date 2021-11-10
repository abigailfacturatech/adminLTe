@extends('layouts.master')


@section('content')
    <form action="{{ route('store_post_path') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter your title here"/>
        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" class="form-control" name="description" placeholder="Enter description here">
        </div>
        <button class="btn btn-dark" type="submit">Save</button>

    </form>
@endsection
