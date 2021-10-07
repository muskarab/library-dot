<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (request('author')) {
            $author = Author::firstWhere('slug', request('author'));
        }

        if (request('title')) {
            $book = Book::firstWhere('slug', request('title'));
            return response()->json([
                "books" => $book
            ], 200);
        }

        return response()->json([
            "books" => Book::latest()->filter(request(['title', 'author']))->paginate()->withQueryString()
        ], 200);
    }
}
