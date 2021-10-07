@extends('layouts.backend')
@section('content')
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Book List</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('book.create') }}"> Create Book</a>
        </div>
    </div>

    <table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Page</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($books as $book)
        <tr>
            <th>{{ $books->count() * ($books->currentPage() - 1) + $loop->iteration }}</th>
            <th>
                <img src="{{ Storage::url('public/books/'.$book->img) }}" width="100" class="img-thumbnail">
            </th>
            <td>{{ $book->title }}</td>
            <td>{!! $book->content !!}</td>
            <td>{{ $book->page }}</td>
            <td>
                <form action="{{ route('book.destroy', $book->slug) }}" method="POST">
                    <a href="{{ route('book.show', $book->slug) }}" class="btn btn-outline-primary btn-sm">Show</a>
                    <a href="{{ route('book.edit', $book->slug) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure to delete this data?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
            
        @endforelse
    </tbody>
    </table>
        {!! $books->links() !!}
@endsection