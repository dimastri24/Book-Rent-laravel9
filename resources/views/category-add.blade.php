@extends('layouts.mainlayout')

@section('title', 'Add Category')

@section('content')
<h2>Add New Category</h2>

<div class="my-3 col col-sm-8 col-md-6 col-lg-5">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/categories/add" method="POST">
        @csrf
        <div class="my-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
        </div>
        <div class="my-3">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </form>
</div>


@endsection