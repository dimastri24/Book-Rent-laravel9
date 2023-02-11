@extends('layouts.mainlayout')

@section('title', 'Add Book')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .image-label {
        cursor: pointer;
    }
</style>

<h2>Add New Book</h2>

<div class="my-3 col">
    <form action="/books/add" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-md-flex flex-md-row gap-5">
            <div class="col col-xxl-5">
                <div class="my-3">
                    <label for="book_code" class="form-label">Code</label>
                    <input type="text" name="book_code" id="book_code" class="form-control" placeholder="Book's Code"
                        value="{{ old('book_code') }}">
                    @error('book_code')
                    <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="my-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Book's Title"
                        value="{{ old('title') }}">
                    @error('title')
                    <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="my-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="categories[]" id="category" class="form-control select-multiple" multiple>
                        {{-- <option value="">Choose Category</option> --}}
                        @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col col-xxl-5">
                <div class="my-3">
                    <label for="image" class="form-label" style="display: block">
                        <img src="{{ asset('images/no-cover-book.jpg') }}" id="preview" class="mb-3 image-label"
                            alt="no cover" width="200">
                    </label>
                    <input type="file" name="image" id="image" class="form-control image-label">
                </div>
            </div>
        </div>

        <div class="my-3">
            <button class="btn btn-success form-control" type="submit">Save</button>
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