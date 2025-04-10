<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-sm text-green-600 dark:text-green-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white dark:bg-[#1e1e1e] p-6 rounded-lg shadow-md dark:shadow-none border border-gray-300 dark:border-[#444]">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="username" class="text-gray-700 dark:text-gray-300" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full bg-gray-100 dark:bg-[#2b2b2b] border border-gray-300 dark:border-[#555] text-gray-900 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="username" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" class="text-gray-700 dark:text-gray-300" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full bg-gray-100 dark:bg-[#2b2b2b] border border-gray-300 dark:border-[#555] text-gray-900 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-[#2b2b2b] border-gray-300 dark:border-[#666] text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-[#1e1e1e]" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-[#1e1e1e]" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

