<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="card max-w-md mx-auto mt-10">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="form-input" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="form-input" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="form-input" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-input" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-sky-400 hover:text-sky-300 underline transition">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>