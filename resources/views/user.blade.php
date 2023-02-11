@extends('layouts.mainlayout')

@section('title', 'Users')

@section('content')
<h2>User List</h2>

<div class="mt-3 text-sm-end">
    <a href="/users/registered-users" class="btn btn-primary me-3">New Registered Users</a>
    <a href="/users/banned" class="btn btn-secondary">Banned Users</a>
</div>

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
                <th>Username</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->username}}</td>
                <td>
                    @if ($item->phone)
                    {{$item->phone}}</td>
                @else
                -
                @endif
                <td>
                    <a href="/users/detail/{{$item->slug}}">detail</a>
                    <a href="/users/ban/{{$item->slug}}">ban user</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-5">
        {{$users->withQueryString()->links()}}
    </div>
</div>
@endsection