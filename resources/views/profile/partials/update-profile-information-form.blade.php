@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6 card text-white space-y-10">

    {{-- Header --}}
    <header class="mb-6">
        <h2 class="text-xl font-semibold text-cyan-300">
            {{ __('Profile') }}
        </h2>
        <p class="mt-1 text-sm text-gray-300">
            {{ __("Update your account's profile information and password.") }}
        </p>
    </header>

    {{-- Verification Resend Form --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Profile Info Form --}}
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div>
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-input"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-input"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-sm text-yellow-400">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="underline text-sm text-sky-400 hover:text-sky-300">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-lime-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        {{-- Profile Image --}}
        <div>
            <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
            <input id="profile_image" name="profile_image" type="file" class="form-input-file" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('profile_image')" />

            <div class="mt-4">
                <img src="{{ asset('storage/' . ($user->profile_image ?? 'profile_images/default-user.jpg')) }}"
                    alt="Profile Image" class="profile-img">
            </div>
        </div>

        {{-- Save Button --}}
        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-lime-400">
                {{ __('Saved.') }}
            </p>
            @endif
        </div>
    </form>

    {{-- Change Password Section --}}
    <section class="border-t border-white/10 pt-6">
        <header>
            <h2 class="text-lg font-semibold text-cyan-300">
                {{ __('Update Password') }}
            </h2>
            <p class="mt-1 text-sm text-gray-300">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>

        <form method="post" action="{{ route('profile.update.password') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                <input id="current_password" name="current_password" type="password" class="form-input"
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400" />
            </div>

            <div>
                <label for="password" class="form-label">{{ __('New Password') }}</label>
                <input id="password" name="password" type="password" class="form-input"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400" />
            </div>

            <div>
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-input"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400" />
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="btn-primary">
                    {{ __('Save') }}
                </button>

                @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-lime-400">
                    {{ __('Saved.') }}
                </p>
                @endif
            </div>
        </form>
    </section>

    {{-- Delete Account --}}
    <section class="border-t border-white/10 pt-6">
        <header>
            <h2 class="text-lg font-semibold text-red-500">
                {{ __('Delete Account') }}
            </h2>
            <p class="mt-1 text-sm text-gray-300">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
            </p>
        </header>

        <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
            @csrf
            @method('delete')

            <div>
                <label for="password" class="form-label text-red-300">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" class="form-input"
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="btn bg-red-600 hover:bg-red-700">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </section>

</div>
@endsection