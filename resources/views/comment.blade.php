@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index3.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="container">
        <div class="comment-form-container">
            <form action="{{ route('comments.store') }}" method="POST" class="comment-form">
                @csrf
                <h1>Nástenka</h1>
                <label for="comment">Koment:</label>
                <textarea name="comment" required></textarea>
                <br>
                <button type="submit">Komentovať</button>
            </form>
        </div>
        <div class="comments-container">
            @foreach($comments as $comment)
                <div class="comment">
                    <p>{{ $comment->user ? $comment->user->name . ':' : 'Anonym' }}</p>
                    <p id="comment-content-{{ $comment->id }}">{{ $comment->comment }}</p>

                    @can('update', $comment)
                        <button class="edit-comment-btn" data-comment-id="{{ $comment->id }}">Upraviť</button>
                    @endcan

                    @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="deleteCommentButton">Odstrániť</button>
                        </form>
                    @endcan
                </div>
            @endforeach
        </div>
    </div>

@endsection
