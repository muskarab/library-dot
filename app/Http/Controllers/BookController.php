<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->when(request()->search, function ($books) {
            $books = $books->where('title', 'like', '%' . request()->search . '%');
        })->paginate(10);

        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create', [
            'authors' => Author::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'image' => request('image') ? ['image', 'mimes:jpg,jpeg,png'] : '',
            'content' => ['required'],
            'page' => ['required']
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/books', $image->hashName());

        $book = Book::create([
            'title' => request('title'),
            'author_id' => request('author'),
            'slug' => Str::slug(request('title')),
            // 'img' => request()->file('image')->store('images/book'),
            'img' => $image->hashName(),
            'content' => request('content'),
            'page' => request('page'),
        ]);

        if ($book) {
            //redirect dengan pesan sukses
            return redirect()->route('book.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('book.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show',
            compact('book'),
            ['authors' => Author::get()]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view(
            'book.edit',
            compact('book'),
            ['authors' => Author::get()]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => ['required'],
            'img' => request('image') ? ['image', 'mimes:jpg,jpeg,png'] : '',
            'content' => ['required'],
            'page' => ['required']
        ]);

        $book = Book::findOrFail($book->id);

        if ($request->file('image') == "") {
            $book->update([
                'title' => request('title'),
                'slug' => Str::slug(request('title')),
                'author_id' => request('author'),
                'content' => request('content'),
                'page' => request('page'),
            ]);
        } else {
            //hapus old image
            Storage::disk('local')->delete('public/books/' . $book->img);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/books', $image->hashName());

            $book->update([
                'title' => request('title'),
                'author_id' => request('author'),
                'slug' => Str::slug(request('title')),
                'img' => $image->hashName(),
                'content' => request('content'),
                'page' => request('page'),
            ]);
        };

        if ($book) {
            //redirect dengan pesan sukses
            return redirect()->route('book.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('book.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book = Book::findOrFail($book->id);
        Storage::disk('local')->delete('public/books/' . $book->img);
        $book->delete();

        if ($book) {
            //redirect dengan pesan sukses
            return redirect()->route('book.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('book.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
