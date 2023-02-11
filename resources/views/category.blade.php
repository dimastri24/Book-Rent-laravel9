@extends('layouts.mainlayout')

@section('title', 'Category')

@section('content')
<h1 class="h2">Category List</h1>

<div class="mt-3 text-sm-end">
    <a href="/categories/add" class="btn btn-primary me-3">Add Category</a>
    <a href="/categories/deleted" class="btn btn-secondary">Deleted Categories</a>
</div>

@if (session('status'))
<div class="alert alert-success my-3">
    {{session('status')}}
</div>
@endif

<div class="mt-3">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->name}}</td>
                <td>
                    <a href="/categories/edit/{{$item->slug}}">edit</a>
                    <a href="/categories/delete/{{$item->slug}}">delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-5">
        {{$categories->withQueryString()->links()}}
    </div>
</div>
@endsection