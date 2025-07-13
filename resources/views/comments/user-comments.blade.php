@extends('layouts.app')

@section('title', 'My Comments')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="card space-y-4"> {{-- استخدمنا كلاس .card الجاهز --}}
            <h2 class="card-title">Your Comments</h2>

            @forelse($comments as $comment)
            <div class="border-b border-slate-700 pb-2">
                <p class="text-indigo-100">{{ $comment->body }}</p>
                <div class="text-sm text-indigo-400 mt-1">
                    On:
                    <a href="{{ route('posts.show', $comment->post) }}" class="text-sky-400 hover:text-sky-300 underline">
                        {{ $comment->post->title }}
                    </a>
                    — {{ $comment->created_at->diffForHumans() }}
                </div>
            </div>
            @empty
            <p class="text-slate-400">You haven't written any comments yet.</p>
            @endforelse

            <div class="mt-4">
                {{ $comments->links}}
            </div>
        </div>
    </div>
</div>
@endsection