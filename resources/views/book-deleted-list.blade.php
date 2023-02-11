@extends('layouts.mainlayout')

@section('title', 'Deleted Books')

@section('content')
<h2>Deleted Books List</h2>

<style>
    .categories {
        display: flex;
        flex-wrap: wrap;
        gap: 5px
    }

    .category {
        background-color: lightblue;
        padding: 0 0.5rem 0 0.5rem;
        border-radius: 5px
    }
</style>

@if (Session::has('status'))
<div class="alert alert-{{Session::get('status')}} my-3">
    {{Session::get('message')}}
</div>
@endif

<div class="my-3">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($books as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->book_code}}</td>
                <td>{{$item->title}}</td>
                <td style="max-width: 150px">
                    <div class="categories">
                        @foreach ($item->categories as $category)
                        <span class="category">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </td>
                <td>{{$item->status}}</td>
                <td>
                    <a href="/books/restore/{{$item->slug}}" class="btn btn-info p-1">restore</a>
                    <form action="/books/delete/{{$item->slug}}" class="d-inline-block" method="POST">
                        @csrf
                        <button type="submit" name="submit" value="force" class="btn btn-danger p-1">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection