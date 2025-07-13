@extends('layouts.app')

@section('title', 'Delete Account')

@section('content')
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Delete Account
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <!-- Trigger Button -->
    <button
        onclick="document.getElementById('delete-modal').classList.remove('hidden')"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        Delete Account
    </button>

    <!-- Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded shadow p-6 w-full max-w-md">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 mb-2">
                    Are you sure you want to delete your account?
                </h2>

                <p class="text-sm text-gray-600 mb-4">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full mt-1 border-gray-300 rounded shadow-sm"
                        placeholder="Password" />
                    @error('password', 'userDeletion')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button
                        type="button"
                        onclick="document.getElementById('delete-modal').classList.add('hidden')"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection