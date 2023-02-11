@extends('layouts.mainlayout')

@section('title', 'Deleted Category')

@section('content')
<h2>Delted Category List</h2>

@if (session('status'))
<div class="alert alert-success my-3">
    {{session('status')}}
</div>
@endif

<div class="my-3">
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
                    <a href="/categories/restore/{{$item->slug}}">restore</a>
                    <a href="/categories/destroy/{{$item->slug}}">destroy</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection