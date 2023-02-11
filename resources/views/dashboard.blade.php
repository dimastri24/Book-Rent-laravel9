@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')

<h1 class="h2">Welcome, {{Auth::user()->username}}</h1>

<div class="row gy-2 mt-5">
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card card-data px-4 py-3 text-white" style="background-color: teal">
            <div class="row">
                <div class="col-4">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <div class="col-8">
                    <div class="card-body text-end">
                        <p class="card-title fs-4 mb-0">Books</p>
                        <p class="card-text fs-6">{{$book_count}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card card-data px-4 py-3 text-white" style="background-color: orangered">
            <div class="row">
                <div class="col-4">
                    <i class="bi bi-list-task"></i>
                </div>
                <div class="col-8">
                    <div class="card-body text-end">
                        <p class="card-title fs-4 mb-0">Categories</p>
                        <p class="card-text fs-6">{{$category_count}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card card-data px-4 py-3 text-white" style="background-color: blueviolet">
            <div class="row">
                <div class="col-4">
                    <i class="bi bi-people"></i>
                </div>
                <div class="col-8">
                    <div class="card-body text-end">
                        <p class="card-title fs-4 mb-0">Users</p>
                        <p class="card-text fs-6">{{$user_count}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-5">
    <h2>#Rent Log</h2>
    <x-rent-log-table :rentlogs='$rent_logs' />
    <div class="mt-3">
        <p class="text-end mb-0"><a href="/rent-logs">See more...</a></p>
    </div>
</div>

@endsection