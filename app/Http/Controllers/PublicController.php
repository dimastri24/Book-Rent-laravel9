<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        if ($request->category && $request->title) {
            $books = Book::where('title', 'LIKE', '%' . $request->title . '%')
                ->orWhereHas('categories', function ($q) use ($request) {
                    $q->where('categories.id', $request->category);
                })
                ->paginate(1);
        } elseif ($request->category) {
            $books = Book::whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            })
                ->paginate(1);
        } elseif ($request->title) {
            $books = Book::where('title', 'LIKE', '%' . $request->title . '%')->paginate(1);
        } else {
            $books = Book::paginate(12);
        }

        return view('book-list', ['books' => $books, 'categories' => $categories,]);
    }
}
