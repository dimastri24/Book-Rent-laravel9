@extends('layouts.mainlayout')

@section('title', 'Profile')

@section('content')
<div class="my-3">
    <h1 class="h2">Welcome Back {{$user->username}}</h1>
    <div class="col col-md-10 col-lg-8 my-3">
        <table class="table table-striped-columns">
            <tr>
                <td>Phone</td>
                <td>{{$user->phone}}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{$user->address}}</td>
            </tr>
            <tr>
                <td>Book Rented</td>
                <td>{{$count}}</td>
            </tr>
        </table>
    </div>
</div>

<div class="mt-3">
    @if ($rent_logs->count() > 0)
    <h2>Your Rent Log</h2>
    <x-rent-log-table :rentlogs='$rent_logs' />
    @else
    <h2>You never rent a book before.</h2>
    @endif
</div>

@endsection