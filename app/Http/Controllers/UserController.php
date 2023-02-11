<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->where('status', 'active')->paginate(10);
        return view('user', ['users' => $users,]);
    }

    public function registeredUser()
    {
        $users = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('registered-user', ['users' => $users,]);
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with(['user:id,username', 'book:id,title'])->where('user_id', $user->id)->paginate(5);
        return view('user-detail', ['user' => $user, 'rent_logs' => $rentlogs,]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('users/detail/' . $slug)->with('status', 'User Approved Successfully');
    }

    public function delete($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('user-delete', ['user' => $user,]);
    }

    public function remove($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();

        return redirect('users/')->with('status', 'User Deleted Successfully');
    }

    public function viewDeleted()
    {
        $deleted = User::onlyTrashed()->get();
        return view('user-deleted-list', ['users' => $deleted,]);
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        return redirect('users')->with('status', 'User Restored Successfully');
    }

    public function profile()
    {
        // $request->session()->flush();
        // dd('ini halaman profile');
        $user = Auth::user();
        $rentlogs = RentLogs::with(['user:id,username', 'book:id,title'])->where('user_id', $user->id)->get();
        $count = RentLogs::where('user_id', $user->id)->where('actual_return_date', null)->count();
        return view('profile', ['rent_logs' => $rentlogs, 'user' => $user, 'count' => $count,]);
    }
}
