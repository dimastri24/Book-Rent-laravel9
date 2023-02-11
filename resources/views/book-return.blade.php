@extends('layouts.mainlayout')

@section('title', 'Return Book')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="col col-sm-10 col-md-8 col-lg-6 offset-md-2 offset-lg-3">
    <h1 class="mb-5">Book Return Form</h1>
    @if (Session::has('status'))
    <div class="alert alert-{{Session::get('status')}} my-3">
        {{Session::get('message')}}
    </div>
    @endif
    <form action="/book-return" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user" class="form-label">User</label>
            <select name="user_id" id="user" class="form-control select-single">
                <option value="">Select User</option>
                @foreach ($users as $item)
                <option value="{{$item->id}}">{{$item->username}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="book" class="form-label">book</label>
            <select name="book_id" id="book" class="form-control select-single">
                <option value="">Select Book</option>
                @foreach ($books as $item)
                <option value="{{$item->id}}">{{$item->book_code}} | {{$item->title}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary form-control">Submit</button>
        </div>
    </form>
</div>
@endsection

@section('seperate-script')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // In your Javascript (external .js resource or <script>tag)
    $(document).ready(function() {
        // theme: "classic"
        $('.select-single').select2();
    });
</script>
@endsection