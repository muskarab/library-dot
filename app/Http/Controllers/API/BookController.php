<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        return response()->json([
            'message' => 'Halaman index Book',
            'data_book' => Book::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'message' => 'Halaman create Book',
        ], 200);
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
            // 'img' => request('image'),
            'content' => request('content'),
            'page' => request('page'),
        ]);
        // dd($request->all());
        if ($book) {
            return response()->json([
                'message' => 'Book berhasil ditambah',
                'data_author' => $book
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book = Book::findOrFail($book->id);
        if ($book) {
            return response()->json([
                'message' => 'Success',
                'data_author' => $book
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
                'publisher_id' => request('publisher'),
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
                'publisher_id' => request('publisher'),
                'slug' => Str::slug(request('title')),
                'img' => $image->hashName(),
                'content' => request('content'),
                'page' => request('page'),
            ]);
        };

        if ($book) {
            return response()->json([
                'message' => 'Book berhasil diupdate',
                'data_author' => $book
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        if ($book) {
            return response()->json([
                'message' => 'Book berhasil didelete',
                'data_author' => $book
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid',
            ], 400);
        }
    }
}
