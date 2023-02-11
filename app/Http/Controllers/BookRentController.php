<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'username')->where('id', '!=', 1)->where('status', 'active')->get();
        $books = Book::select('id', 'title')->where('status', 'in stock')->get();
        // $books = Book::select('id', 'title')->get();
        return view('book-rent', ['users' => $users, 'books' => $books,]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        $book = Book::findOrFail($request->book_id)->only('status');

        if ($book['status'] != 'in stock') {
            Session::flash('status', 'danger');
            Session::flash('message', 'Book is not available!');
            return redirect('book-rent');
        } else {
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            if ($count >= 3) {
                Session::flash('status', 'danger');
                Session::flash('message', 'User has reach rent limit!');
                return redirect('book-rent');
            }
            try {
                DB::beginTransaction();
                // process insert to rent_logs table
                RentLogs::create($request->all());
                // process update book table
                $editBook = Book::findOrFail($request->book_id);
                $editBook->status = 'not available';
                $editBook->save();
                DB::commit();

                Session::flash('status', 'success');
                Session::flash('message', 'Rent Book Success!');
                return redirect('book-rent');
            } catch (\Throwable $th) {
                DB::rollBack();
                // dd($th);
            }
        }
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();

        return view('check-out', ['book' => $book,]);
    }

    public function rent(Request $request)
    {
        // dd($request)->all();
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();
        // dd($count);
        if ($count >= 3) {
            Session::flash('status', 'danger');
            Session::flash('message', 'User has reach rent limit!');
            return redirect('/');
        }
        try {
            DB::beginTransaction();
            // process insert to rent_logs table
            RentLogs::create($request->all());
            // process update book table
            $editBook = Book::findOrFail($request->book_id);
            $editBook->status = 'not available';
            $editBook->save();
            DB::commit();

            Session::flash('status', 'success');
            Session::flash('message', 'Rent Book Success!');
            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('status', 'danger');
            Session::flash('message', 'There is an error when trying to rent out the book!');
            return redirect('/');
        }
    }

    public function bookReturn()
    {
        $users = User::select('id', 'username')->where('id', '!=', 1)->where('status', 'active')->get();
        // $books = Book::select('id', 'title', 'book_code')->where('status', 'not available')->get();
        $books = Book::select('id', 'title', 'book_code')->get();
        return view('book-return', ['users' => $users, 'books' => $books,]);
    }

    public function bookReturnDetail(Request $request)
    {
        dd($request)->all();
        // return redirect()->route('book-return-detail', ['id' => value,]);
    }

    public function storeBookReturn(Request $request)
    {
        dd($request)->all();
        $rent = RentLogs::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->where('actual_return_date', null);
        $rentData = $rent->first();
        $count = $rent->count();

        if ($count == 1) {
            try {
                DB::beginTransaction();
                $rentData->actual_return_date = Carbon::now()->toDateString();
                $rentData->save();

                $editBook = Book::findOrFail($request->book_id);
                $editBook->status = 'in stock';
                $editBook->save();

                DB::commit();

                Session::flash('status', 'success');
                Session::flash('message', 'Returning Book Success!');
                return redirect('book-return');
            } catch (\Throwable $e) {
                DB::rollBack();
                Session::flash('status', 'danger');
                Session::flash('message', 'There is an error when trying to return the book!');
                return redirect('book-return');
            }
        } else {
            Session::flash('status', 'danger');
            Session::flash('message', 'There is no record of rented book!');
            return redirect('book-return');
        }
    }
}
