<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function index()
    {
        // $request->session()->flush();
        // dd('ini halaman buku');
        $books = Book::paginate(10);
        return view('book', ['books' => $books,]);
    }

    public function add()
    {
        $categories = Category::all();
        return view('book-add', ['categories' => $categories,]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
        ]);

        $newName = '';

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $noSpace = preg_replace('/\s+/', '', $request->title);
            $noQuote = preg_replace("/'/", '', $noSpace);
            $strName = preg_replace('/[&\/\\#^+()$~%.":*?<>{}!@]/', '', $noQuote);
            $newName = strtolower($strName) . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;

        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        Session::flash('status', 'success');
        Session::flash('message', 'Book Added Successfully!');
        return redirect('books');
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('book-edit', ['book' => $book, 'categories' => $categories,]);
    }

    public function update(Request $request, $slug)
    {
        // dd($request->all());
        $book = Book::where('slug', $slug)->first();

        $oldPhoto = $book->image;
        $file_path = 'cover/' . $oldPhoto;

        $booksCategoryCollection = $book->categories->pluck('id')->all();

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $noSpace = preg_replace('/\s+/', '', $request->title);
            $noQuote = preg_replace("/'/", '', $noSpace);
            $strName = preg_replace('/[&\/\\#^+()$~%.":*?<>{}!@]/', '', $noQuote);
            // dd($strName);
            $newName = strtolower($strName) . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;

            if (isset($oldPhoto) || $oldPhoto != '') {
                if (Storage::exists($file_path)) {
                    Storage::delete($file_path);
                }
            }
        }

        $book->slug = null;
        $book->update($request->all());

        if ($request->categories != $booksCategoryCollection) {
            $book->categories()->sync($request->categories);
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Book Added Successfully!');
        return redirect('books');
    }

    public function viewDeleted()
    {
        $deleted = Book::onlyTrashed()->get();
        return view('book-deleted-list', ['books' => $deleted,]);
    }

    public function delete(Request $request, $slug)
    {
        $book = null;
        $action = $request->input('submit');

        switch ($request->input('submit')) {
            case 'soft':
                $book = Book::where('slug', $slug)->first();
                break;

            case 'force':
                $book = Book::withTrashed()->where('slug', $slug)->first();
                // dd($bookTemp);
                // dd('force delete');
                break;

            default:
                Session::flash('status', 'danger');
                Session::flash('message', 'Book Deleted Failed!');
                return redirect('books');
                // abort('404');
                break;
        }

        return view('book-delete', ['book' => $book, 'action' => $action,]);
    }

    public function remove(Request $request, $slug)
    {
        switch ($request->input('submit')) {
            case 'soft':
                // dd('soft delete');
                $book = Book::where('slug', $slug)->first();
                $book->delete();
                break;

            case 'force':
                // dd('force delete');
                $book = Book::withTrashed()->where('slug', $slug)->first();
                $book->forceDelete();
                break;

            default:
                Session::flash('status', 'danger');
                Session::flash('message', 'Book Deleted Failed!');
                return redirect('books');
                // abort('404');
                break;
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Book Deleted Successfully!');
        return redirect('books');
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        Session::flash('status', 'success');
        Session::flash('message', 'Book Added Successfully!');
        return redirect('books');
    }

    // public function destroy($slug)
    // {
    //     // dd($slug);
    //     $category = Book::withTrashed()->where('slug', $slug)->first();
    //     $category->forceDelete();
    //     return redirect('categories/deleted')->with('status', 'Category Delete Successfully');
    // }
}
