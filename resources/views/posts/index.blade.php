@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6 bg-slate-800/60 backdrop-blur-md text-indigo-100 rounded-2xl shadow-lg border border-slate-700">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-cyan-300">All Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn-primary">
            + Create New Post
        </a>
    </div>

    @if($posts->count())
    <ul class="space-y-6">
        @foreach($posts as $post)
        <li class="card">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="text-sm text-slate-400 mb-2">
                By {{ $post->user->name }} &middot; {{ $post->created_at->format('M d, Y') }}
            </p>

            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>

            @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}"
                alt="Post Image"
                class="mt-4 max-h-64 w-full object-cover rounded-xl border border-slate-600 shadow-sm">
            @endif

            <div class="mt-4 flex gap-4 text-sm">
                <a href="{{ route('posts.show', $post) }}" class="text-cyan-400 hover:underline">Read More</a>
                @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}" class="text-cyan-400 hover:underline">Edit</a>
                @endcan
            </div>
        </li>
        @endforeach
    </ul>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
    @else
    <p class="text-slate-400">No posts found.</p>
    @endif
</div>
@endsection