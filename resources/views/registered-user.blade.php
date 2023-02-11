@extends('layouts.mainlayout')

@section('title', 'Users')

@section('content')
<h2>New Registered User List</h2>

<div class="mt-3 text-end">
    <a href="/users" class="btn btn-primary me-3">Approved Users</a>
</div>

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
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection