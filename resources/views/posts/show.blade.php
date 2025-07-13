@extends('layouts.app')
@section('title', $post->title)
@section('content')

<div class="max-w-2xl mx-auto px-4 py-6 bg-slate-800/60 backdrop-blur-md text-indigo-100 rounded-2xl shadow-lg border border-slate-700">
    <article class="card p-6">
        <h1 class="text-3xl font-bold text-cyan-300 mb-4">{{ $post->title }}</h1>

        <p class="text-sm text-cyan-400 mb-4">
            By <span class="font-semibold">{{ $post->user->name }}</span> on {{ $post->created_at->format('F j, Y') }}
        </p>

        <div class="text-indigo-100 whitespace-pre-line">
            {{ $post->content }}
        </div>

        @if ($post->image)
        <div class="mt-6">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                class="w-full max-h-80 object-cover rounded-xl border border-slate-600 shadow-sm">
        </div>
        @endif

        <div class="mt-6 flex gap-4">
            @can('update', $post)
            <a href="{{ route('posts.edit', $post) }}" class="btn-outline">Edit Post</a>
            @endcan

            @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-outline text-red-400 hover:text-red-300">Delete Post</button>
            </form>
            @endcan
        </div>
    </article>

    {{-- Comments --}}
    <div class="mt-10">
        <h2 class="text-xl font-bold text-cyan-300 mb-4">Comments</h2>

        @auth
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6 space-y-2">
            @csrf
            <label for="content" class="form-label">Add a comment</label>
            <textarea name="content" id="content" rows="3" class="form-textarea" placeholder="Write something..."></textarea>
            <button type="submit" class="btn-primary">Post Comment</button>
        </form>
        @endauth

        @foreach ($post->comments as $comment)
        <div class="card p-4 mb-4">
            <div class="flex items-center gap-3 mb-2">
                <img
                    src="{{ $comment->user->profile_image ? asset('storage/' . $comment->user->profile_image) : asset('images/default-profile.png') }}"
                    alt="Profile Image"
                    class="profile-img">
                <div>
                    <p class="text-sm font-medium text-cyan-300">{{ $comment->user->name }}</p>
                    <p class="text-xs text-cyan-500">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>

            @if(request('edit_comment') == $comment->id && auth()->id() === $comment->user_id)
            <form action="{{ route('comments.update', $comment) }}" method="POST" class="mt-2 space-y-2">
                @csrf
                @method('PUT')
                <textarea name="content" rows="3" class="form-textarea">{{ old('content', $comment->content) }}</textarea>
                <div class="flex gap-2">
                    <button type="submit" class="btn-primary">Save</button>
                    <a href="{{ route('posts.show', $post) }}" class="btn-outline">Cancel</a>
                </div>
            </form>
            @else
            <p class="text-indigo-100 mb-2">{{ $comment->content }}</p>
            @endif

            <div class="text-sm text-cyan-400 flex gap-3">
                @can('update', $comment)
                <a href="{{ route('posts.show', $post) }}?edit_comment={{ $comment->id }}" class="hover:underline">Edit</a>
                @endcan

                @can('delete', $comment)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="hover:underline text-red-400 ml-2">Delete</button>
                </form>
                @endcan
            </div>
        </div>
        @endforeach
    </div>
    <div>
        <button>
            <a href="{{ route('posts.index') }}" class="btn-primary">Back to Posts</a>
        </button>
    </div>
</div>
@endsection