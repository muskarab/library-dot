@extends('layouts.backend')
@section('content')
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Author List</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('author.create') }}"> Create Author</a>
        </div>
    </div>

    <table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($authors as $author)
        <tr>
            <th>{{ $authors->count() * ($authors->currentPage() - 1) + $loop->iteration }}</th>
            <td>{{ $author->name }}</td>
            <td>
                <form action="{{ route('author.destroy', $author->slug) }}" method="POST">
                    <a href="/dashboard?author={{ $author->slug }}" class="btn btn-outline-primary btn-sm">Show</a>
                    <a href="{{ route('author.edit', $author->slug) }}" class="btn btn-outline-warning btn-sm">Edit</a>
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
        {!! $authors->links() !!}
@endsection