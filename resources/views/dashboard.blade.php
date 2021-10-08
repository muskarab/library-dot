@extends('layouts.backend')

@section('content')
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <form action="/dashboard">
                {{-- @if (request('author'))
                    <input type="hiden" name="author" value="{{ request('author') }}">
                @elseif (request('publisher'))
                    <input type="hiden" name="publisher" value="{{ request('publisher') }}">
                @endif --}}
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by title..." name="title" value="{{ request('title') }}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>{{ $title }}</h2>
        </div>
        {{-- <div class="float-right">
            <a class="btn btn-primary" href="{{ route('book.create') }}"> Create Book</a>
        </div> --}}
    </div>

    <table class="table">
    <thead>
        <tr>
            {{-- <th>No.</th> --}}
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Author</th>
            <th scope="col">Page</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($books as $book)
        <tr>
            {{-- <th>{{ $books->count() * ($books->currentPage() - 1) + $loop->iteration }}</th> --}}
            <th>
                <img src="{{ Storage::url('public/books/'.$book->img) }}" width="100" class="img-thumbnail">
            </th>
            <td>
                {{-- <a href="{{ route('book.show', $book->slug) }}" class="text-decoration-none text-dark"> --}}
                    {{ $book->title }}
                {{-- </a> --}}
            </td>
            <td>{!! $book->content !!}</td>
            <td>
                <a href="/dashboard?author={{ $book->author->slug }}" class="text-decoration-none text-dark">{{ $book->author->name }}</a>
            </td>
            <td>{{ $book->page }}</td>
            <td>{{ $book->date }}</td>
        </tr>
        @empty
            
        @endforelse
    </tbody>
    </table>
        {!! $books->links() !!}
@endsection