@extends('layouts.app')

@section('content')
<div class="container">
    <h1>本棚</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
    <div class="row mt-4">
        @foreach ($books as $book)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->name }}</h5>
                    <p class="card-text">{{ $book->genre }}</p>
                    @if ($book->photo)
                    <img src="{{ asset('storage/photos/' . $book->photo) }}" alt="Book photo" class="img-fluid">
                    @endif
                    <a href="{{ route('books.show', $book) }}" class="btn btn-primary">show</a>
                    <!-- <a href="{{ route('books.edit', $book) }}" class="btn btn-warning mt-2">Edit</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2">Delete</button>
                    </form> -->
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection