@extends('layouts.mainlayout')

@section('title', 'Check Out Book')

@section('content')
<div class="my-3">
    <h1 class="h2">Book You want to Rent</h1>
    <div class="d-sm-flex gap-5 mt-3">
        <div class="">
            @if ($book->cover != '')
            <img src="{{ asset('storage/cover/'.$book->cover) }}" alt="cover book" width="200" id="preview"
                class="mb-3">
            @else
            <img src="{{ asset('images/no-cover-book.jpg') }}" alt="no cover" width="200" id="preview" class="mb-3">
            @endif
        </div>
        <div class="flex-fill">
            <table class="table">
                <tr>
                    <td class="col-2">Code</td>
                    <td>{{$book->book_code}}</td>
                </tr>
                <tr>
                    <td>Title</td>
                    <td>{{$book->title}}</td>
                </tr>
            </table>
            <form action="/rent-book" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="book_id" value="{{$book->id}}">
                <button type="submit" class="btn btn-success px-5">Confirm</button>
            </form>
        </div>
    </div>
</div>

@endsection