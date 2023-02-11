@extends('layouts.mainlayout')

@section('title', 'Delete User')

@section('content')
<h2>Are you sure to delete User {{$user->username}}?</h2>

<div class="my-5">
    <a href="/users/remove/{{$user->slug}}" class="btn btn-danger me-3 px-3">Sure</a>
    <a href="{{url()->previous()}}" class="btn btn-warning px-3">Cancel</a>
</div>

@endsection