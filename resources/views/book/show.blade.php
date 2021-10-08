@extends('layouts.backend')
@section('content')
    <div class="text-center">
        <img src="{{ Storage::url('public/books/'.$book->img) }}" class="img-fluid" alt="..." width="300">
    </div>
    <h5>Title:</h5>
    <input class="form-control" type="text" placeholder="{{ $book->title }}" aria-label="Disabled input example" disabled>
    @foreach ($authors as $author)
        @if ($book->author_id == $author->id)
            <h5>Author:</h5>
            <input class="form-control" type="text" placeholder="{{ $author->name }}" aria-label="Disabled input example" disabled>
        @endif
    @endforeach
    <h5>Content:</h5>
    <article>
        <p>{!! $book->content !!}</p>
    </article>
    <h5>Page:</h5>
    <input class="form-control" type="text" placeholder="{{ $book->page }}" aria-label="Disabled input example" disabled>
    <h5>Date:</h5>
    <input class="form-control" type="text" placeholder="{{ $book->created_at }}" aria-label="Disabled input example" disabled>
    <a class="btn btn-primary" href="{{ route('book.index') }}"> Back</a>
@endsection