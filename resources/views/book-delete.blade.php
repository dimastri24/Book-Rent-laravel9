@extends('layouts.mainlayout')

@section('title', 'Delete Book')

@section('content')
<h2>Are you sure to delete Book {{$book->title}}?</h2>
<div class="my-5">
    <form action="/books/remove/{{$book->slug}}" method="POST">
        @method('DELETE')
        @csrf
        @if ($action == 'soft')
        <button class="btn btn-danger fs-3 fw-bold px-3 py-2" type="submit" name="submit" value="soft">Sure</button>
        @endif
        @if ($action == 'force')
        <button class="btn btn-danger fs-3 fw-bold px-3 py-2" type="submit" name="submit" value="force">Yes,
            Delete</button>
        @endif
        <a href="{{url()->previous()}}" class="btn btn-warning fs-3 fw-bold px-3 py-2 ms-3">Cancel</a>
    </form>
    {{-- <a href="/books/remove/{{$book->slug}}" class="btn btn-danger me-3 px-3">Sure</a> --}}
</div>

@endsection