@extends('layouts.mainlayout')

@section('title', 'Rent Logs')

@section('content')


<h1 class="h2">Rent Log List</h1>

<div class="my-5">
    <x-rent-log-table :rentlogs='$rent_logs' paginate=true />
</div>
@endsection