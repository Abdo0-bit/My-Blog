<x-guest-layout>
    <!-- Session Status -->
     
    <x-auth-session-status class="mb-4 text-cyan-300" :status="session('status')" />
    

    <form method="POST" action="{{ route('login') }}" class="card max-w-md mx-auto mt-10">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="form-input" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="form-input" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-700 text-cyan-500 bg-slate-800 shadow-sm focus:ring-cyan-500" name="remember">
                <span class="ms-2 text-sm text-indigo-300">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
            <a class="text-sm text-sky-400 hover:text-sky-300 underline transition" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <button type="submit" class="btn-primary">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>