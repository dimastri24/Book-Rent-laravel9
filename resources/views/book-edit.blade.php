@extends('layouts.mainlayout')

@section('title', 'Edit Book')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .image-label {
        cursor: pointer;
    }
</style>

<h2>Edit Book</h2>

<div class="my-3 col col-sm-8 col-md-6 col-lg-5">
    <form action="/books/edit/{{$book->slug}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="my-3">
            <label for="book_code" class="form-label">Code</label>
            <input type="text" name="book_code" id="book_code" class="form-control" placeholder="Book's Code"
                value="{{ $book->book_code }}">
        </div>
        <div class="my-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Book's Title"
                value="{{ $book->title }}">
        </div>
        <div class="my-3">
            <label for="image" class="form-label" style="display: block">
                @if ($book->cover != '')
                <img src="{{ asset('storage/cover/'.$book->cover) }}" alt="cover book" width="200" id="preview"
                    class="mb-3 image-label">
                @else
                <img src="{{ asset('images/no-cover-book.jpg') }}" alt="no cover" width="200" id="preview"
                    class="mb-3 image-label">
                @endif
            </label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="my-3">
            <label for="category" class="form-label">Category</label>
            <select name="categories[]" id="category" class="form-control select-multiple" multiple>
                @foreach ($categories as $item)
                <option value="{{ $item->id }}" {{ ($book->categories->contains($item->id)) ? 'selected' : ''}}>
                    {{ $item->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="my-3">
            <button class="btn btn-success px-4 py-2 fs-5 fw-semibold" type="submit">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-warning px-4 py-2 fs-5 fw-semibold">Cancel</a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // In your Javascript (external .js resource or <script>tag)
    $(document).ready(function() {
        $('.select-multiple').select2();
    });

    $(document).ready(function (e) {
        $('#image').change(function(){
        let reader = new FileReader();
        
        reader.onload = (e) => {
        $('#preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(this.files[0]);
        });
    });

</script>
@endsection