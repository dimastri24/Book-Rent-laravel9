<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $rentlogs = RentLogs::with(['user:id,username', 'book:id,title'])
            ->latest()
            ->limit(5)
            ->get();
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        return view(
            'dashboard',
            [
                'book_count' => $bookCount,
                'category_count' => $categoryCount,
                'user_count' => $userCount,
                'rent_logs' => $rentlogs,
            ]
        );
    }
}
