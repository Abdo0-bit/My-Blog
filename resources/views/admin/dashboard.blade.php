@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-lime-400 leading-tight">
    Admin Dashboard
</h2>
@endsection

@section('content')
<div class="py-12 bg-gradient-to-br from-black via-slate-900 to-indigo-950 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="card">
                <h3 class="card-title">Users</h3>
                <p class="text-3xl font-bold text-indigo-100">{{ $users_count }}</p>
            </div>
            <div class="card">
                <h3 class="card-title">Posts</h3>
                <p class="text-3xl font-bold text-indigo-100">{{ $posts_count }}</p>
            </div>
            <div class="card">
                <h3 class="card-title">Comments</h3>
                <p class="text-3xl font-bold text-indigo-100">{{ $comments_count }}</p>
            </div>
        </div>

        <!-- Latest Users -->
        <div class="mt-10">
            <h3 class="text-xl font-semibold text-cyan-300 mb-4">Latest Users</h3>
            <ul class="card divide-y divide-slate-700">
                @forelse ($latest_users as $user)
                <li class="py-3">
                    <div class="font-medium text-lime-300">{{ $user->name }}</div>
                    <div class="text-sm text-slate-400">{{ $user->email }}</div>
                </li>
                @empty
                <li class="p-4 text-slate-400">No users found.</li>
                @endforelse
            </ul>
        </div>

        <!-- All Users Table -->
        <div class="mt-10">
            <h3 class="text-xl font-semibold text-cyan-300 mb-4">All Users</h3>
            <div class="card overflow-x-auto p-0">
                <table class="min-w-full divide-y divide-slate-700 text-sm">
                    <thead class="bg-slate-700 text-lime-300 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700 text-indigo-100">
                        @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-400">{{ $user->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 text-sky-400">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</div>
@endsection