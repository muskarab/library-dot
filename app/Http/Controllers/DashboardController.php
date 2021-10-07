<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('author')) {
            $author = Author::firstWhere('slug', request('author'));
            $title = ' author by ' . $author->name;
        }

        if (request('title')) {
            $book = Book::firstWhere('title', request('title'));
            $title = ' title ' . $book->title;
        }

        return view('dashboard', [
            "title" => "Book" . $title,
            // "active" => "post",
            // "posts" => Post::all()
            "books" => Book::latest()->filter(request(['title', 'author']))->paginate(10)->withQueryString()
        ]);
    }
}
