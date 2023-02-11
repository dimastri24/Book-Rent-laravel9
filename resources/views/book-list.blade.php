@extends('layouts.mainlayout')

@section('title', 'Books')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<style>
    .instock {
        all: unset;
        background-color: aquamarine;
        color: green;
        border: none;
        text-decoration: none;
        padding: 0.5rem;
        border-radius: 5px;
        cursor: pointer;
    }

    .instock:hover {
        color: green;
        filter: brightness(90%);
    }

    .notavail {
        background-color: khaki;
        color: darkorange;
    }
</style>
{{request('category')}}
<form action="" class="my-3" method="GET">
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-5 mb-3">
            <select name="category" id="category" class="form-control" data-size="5" data-live-search="true">
                <option value="">Select Category</option>
                @foreach ($categories as $item)
                @if (request('category') == $item->id)
                <option value="{{request('category')}}" data-tokens="{{$item->name}}" selected>{{$item->name}}</option>
                @else
                <option value="{{$item->id}}" data-tokens="{{$item->name}}">{{$item->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 col-lg-7 mb-3">
            <div class="input-group">
                <input type="text" name="title" id="title" class="form-control" placeholder=" search books title.."
                    value="{{request('title')}}">
                <button class="btn btn-outline-secondary" type="submit" id="search">Search</button>
            </div>
        </div>
    </div>
</form>
@if (Session::has('status'))
<div class="alert alert-{{Session::get('status')}} my-3">
    {{Session::get('message')}}
</div>
@endif
<div class="my-5">
    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4">
        @foreach ($books as $item)
        <div class="col mb-3">
            <div class="card h-100">
                @if ($item->cover != '')
                <img src="{{asset('storage/cover/'.$item->cover)}}" class="card-img-top w-75 mx-auto" alt="cover book"
                    draggable="false">
                @else
                <img src="{{asset('images/no-cover-book.jpg')}}" class="card-img-top w-75 mx-auto" alt="cover book"
                    draggable="false">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$item->book_code}}</h5>
                    <p class="card-text">{{$item->title}}</p>
                    <div class="d-flex justify-content-end">
                        @if ($item->status == 'in stock')
                        <a href="/rent-book/{{$item->slug}}" class="instock">Rent Now</a>
                        @else
                        <p class="card-text fw-bold text-warning">
                            {{$item->status}}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="my-5">
    {{$books->withQueryString()->links()}}
</div>
@endsection

@section('seperate-script')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $('#category').selectpicker();
</script>
@endsection