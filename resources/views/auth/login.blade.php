@include('layouts.header', ['title' => 'Login'])

<div class="max-w-md mx-auto bg-[#57B404] p-8 rounded-lg shadow-md mt-10">
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-gray-700 font-semibold mb-1" />
            <x-text-input
                id="email"
                class="block w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="block text-gray-700 font-semibold mb-1" />
            <x-text-input
                id="password"
                class="block w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
            />
            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Forgot Password and Login Button -->
        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
