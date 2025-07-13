@extends('layouts.app')
@section('title', 'Create Post')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-3xl bg-slate-800/60 backdrop-blur-md text-indigo-100 rounded-2xl shadow-lg border border-slate-700">

    <h2 class="text-2xl font-semibold text-cyan-300 mb-6">Create a New Post</h2>

    @if ($errors->any())
    <div class="bg-red-900/80 border border-red-600 text-red-300 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Title -->
        <div>
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title"
                class="form-input"
                value="{{ old('title') }}" required>
        </div>

        <!-- Content -->
        <div>
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" rows="5"
                class="form-textarea"
                required>{{ old('content') }}</textarea>
        </div>

        <!-- Image -->
        <div>
            <label for="image" class="form-label">Image (Optional)</label>
            <input type="file" name="image" id="image"
                class="w-full text-white file:bg-slate-700 file:border-0 file:px-4 file:py-2 file:rounded file:text-sm file:text-white hover:file:bg-slate-600">
        </div>

        <!-- Submit -->
        <div>
            <button type="submit" class="btn-primary">
                Publish
            </button>
        </div>
    </form>
</div>
@endsection