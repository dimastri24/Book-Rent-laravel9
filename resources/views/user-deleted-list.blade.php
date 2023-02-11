@extends('layouts.mainlayout')

@section('title', 'Banned Users')

@section('content')
<h2>Banned User List</h2>

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
                    <a href="/users/restore/{{$item->slug}}">restore</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection