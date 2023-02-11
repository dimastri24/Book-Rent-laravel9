@extends('layouts.mainlayout')

@section('title', 'Users')

@section('content')
<style>
    .status-active {
        background-color: aquamarine;
        color: green;
    }

    .status-inactive {
        background-color: khaki;
        color: darkorange;
    }
</style>

<h2>Detail User</h2>

<div class="mt-3 text-end">
    @if ($user->status == 'inactive')
    <a href="/users/approve/{{$user->slug}}" class="btn btn-info">Approve Users</a>
    @endif
</div>

<div class="row">
    <div class="col col-sm-12 col-md-8 col-xl-6">
        {{-- @if (session('status')) --}}
        <div class="alert alert-success my-3">
            {{session('status')}}status
        </div>
        {{-- @endif --}}
        <div class="mb-3">
            <label for="" class="form-label">Username</label>
            <input type="text" class="form-control" readonly value="{{$user->username}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <input type="text" class="form-control" readonly value="{{$user->phone}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Address</label>
            <textarea name="" id="" rows="5" class="form-control" style="resize: none"
                readonly>{{$user->address}}</textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Status</label>
            <div
                class="w-full text-center py-2 rounded-pill {{($user->status == 'active') ? 'status-active' : 'status-inactive'}}">
                <p class="fw-bolder m-0">{{$user->status}}</p>
            </div>
        </div>
    </div>

    <div class="col col-sm-12 col-xl-6">
        <x-rent-log-table :rentlogs='$rent_logs' paginate=true />
    </div>
</div>
@endsection