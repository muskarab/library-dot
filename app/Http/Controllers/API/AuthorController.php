<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => 'Halaman index Author',
            'data_author' => Author::all()
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
            'message' => 'Halaman create Author',
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
            'name' => ['required']
        ]);

        $author = Author::create([
            'name' => request('name'),
            'slug' => Str::slug(request('name'))
        ]);

        // dd($request->all());
        if ($request) {
            return response()->json([
                'message' => 'Author berhasil ditambah',
                'data_author' => $author
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
    public function show(Author $author)
    {
        $author = Author::findOrFail($author->id);
        if ($author) {
            return response()->json([
                'message' => 'Success',
                'data_author' => $author
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
        $author = Author::find($id);
        if ($author) {
            return response()->json([
                'message' => 'Success',
                'data_author' => $author
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => ['required']
        ]);
        $author = Author::findOrFail($author->id);
        $author->update([
            'name' => request('name'),
            'slug' => Str::slug(request('name'))
        ]);

        if ($author) {
            return response()->json([
                'message' => 'Author berhasil diupdate',
                'data_author' => $author
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
    public function destroy(Author $author)
    {
        $author->delete();
        if ($author) {
            return response()->json([
                'message' => 'Author berhasil didelete',
                'data_author' => $author
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid',
            ], 400);
        }
    }
}
