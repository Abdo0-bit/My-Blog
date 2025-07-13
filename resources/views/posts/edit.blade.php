@extends('layouts.app')

@section('title', 'Edit Post: ' . $post->title)

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8 bg-slate-800/60 backdrop-blur-md text-indigo-100 rounded-2xl shadow-lg border border-slate-700">
    <h1 class="text-3xl font-bold text-cyan-300 mb-6">Edit Post: <span class="text-white">{{ $post->title }}</span></h1>

    @if ($errors->any())
    <div class="bg-red-900/80 border border-red-600 text-red-300 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                class="form-input" required>
        </div>

        <!-- Content -->
        <div>
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" rows="6"
                class="form-textarea resize-none"
                required>{{ old('content', $post->content) }}</textarea>
        </div>

        <!-- Image -->
        <div>
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image"
                class="form-input">

            @if ($post->image)
            <div class="mt-4">
                <p class="text-sm text-slate-400 mb-2">Current Image:</p>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image"
                    class="w-full max-h-72 object-cover rounded-lg shadow border border-slate-600">
            </div>
            @endif
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center pt-4">
            <button type="submit"
                class="btn-primary">
                Update Post
            </button>
            <a href="{{ route('posts.show', $post) }}" class="text-sm text-slate-400 hover:text-cyan-300 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection