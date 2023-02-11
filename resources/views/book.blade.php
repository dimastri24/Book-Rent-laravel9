@extends('layouts.mainlayout')

@section('title', 'Books')

@section('content')
<h1 class="h2">Books List</h1>

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

<div class="mt-3 text-sm-end">
    <a href="/books/add" class="btn btn-primary me-3">Add Book</a>
    <a href="/books/deleted" class="btn btn-secondary">Deleted Books</a>
</div>

@if (Session::has('status'))
<div class="alert alert-{{Session::get('status')}} my-3">
    {{Session::get('message')}}
</div>
@endif

<div class="my-3 table-responsive-md">
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
                <td style="max-width: 200px">{{Str::limit($item->title, 35, '...')}}</td>
                <td style="max-width: 150px">
                    <div class="categories">
                        @foreach ($item->categories as $category)
                        <span class="category">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </td>
                <td>{{$item->status}}</td>
                <td>
                    <a href="/books/edit/{{$item->slug}}" class="btn btn-info p-1">edit</a>
                    <form action="/books/delete/{{$item->slug}}" class="d-inline-block" method="POST">
                        @csrf
                        <button type="submit" name="submit" value="soft" class="btn btn-danger p-1">delete</button>
                    </form>
                    {{-- <a href="/books/delete/{{$item->slug}}">delete</a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-5">
        {{$books->withQueryString()->links()}}
    </div>
</div>
@endsection