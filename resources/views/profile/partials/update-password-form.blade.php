@extends('layouts.app')

@section('title', 'Update Password')

@section('content')
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update.password') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-gray-700">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block font-medium text-sm text-gray-700">New Password</label>
            <input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            @error('password', 'updatePassword')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-gray-700">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Save</button>

            @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">Saved.</p>
            @endif
        </div>
    </form>
</section>
@endsection