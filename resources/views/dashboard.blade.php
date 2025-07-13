@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-lime-400 leading-tight">
    Dashboard
</h2>
@endsection

@section('content')
<div class="py-12 bg-gradient-to-br from-black via-slate-900 to-indigo-950 min-h-screen text-indigo-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="space-y-6">

            {{-- Welcome Message --}}
            <h1 class="text-2xl font-bold text-lime-300">
                Welcome, {{ $user->name }}
            </h1>

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card">
                    <h3 class="card-title">Your Posts</h3>
                    <p class="text-3xl mt-2 font-bold">{{ $posts_count }}</p>
                </div>
                <div class="card">
                    <h3 class="card-title">Your Comments</h3>
                    <p class="text-3xl mt-2 font-bold">{{ $comments_count }}</p>
                    <a href="{{ route('comments.user') }}" class="text-sky-400 hover:text-sky-300 text-sm transition mt-2 inline-block">
                        View All Comments →
                    </a>
                </div>
            </div>

            {{-- User Comments --}}
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-cyan-300 mb-2">Your Comments</h3>
                <ul class="space-y-3">
                    @forelse($latest_comments as $comment)
                    <li class="border-b border-slate-700 pb-2">
                        <p class="text-indigo-100">{{ $comment->body }}</p>
                        <div class="text-sm text-sky-400">
                            On post:
                            <a href="{{ route('posts.show', $comment->post) }}" class="hover:text-sky-300 transition">
                                {{ $comment->post->title }}
                            </a>
                            <span class="text-slate-400"> | {{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                    </li>
                    @empty
                    <li class="text-slate-400">No comments yet.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Latest Posts --}}
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-cyan-300 mb-2">Latest Posts</h3>
                <ul class="space-y-3">
                    @forelse($latest_posts as $post)
                    <li class="border-b border-slate-700 pb-2">
                        <a href="{{ route('posts.show', $post) }}" class="text-sky-400 hover:text-sky-300 transition font-medium">
                            {{ $post->title }}
                        </a>
                        <div class="text-sm text-slate-400">{{ $post->created_at->format('Y-m-d') }}</div>
                    </li>
                    @empty
                    <li class="text-slate-400">No posts found.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Add Post Button --}}
            <div class="mt-6">
                <a href="{{ route('posts.create') }}" class="inline-block px-4 py-2 bg-lime-500 text-black font-semibold rounded hover:bg-lime-400 transition">
                    Create New Post
                </a>
            </div>

        </div>
    </div>
</div>
@endsection