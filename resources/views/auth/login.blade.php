<x-guest-layout>

    <!-- Login Card -->
    <div class="max-w-md mx-auto mt-12 bg-white shadow-lg p-8 rounded-2xl border border-gray-200
                animate-fadeIn transition-all duration-700">

        <!-- Title -->
        <h2 class="text-3xl font-bold text-center mb-2 text-gray-800 animate-slideDown">
            Welcome Back 👋
        </h2>
        <p class="text-center text-gray-600 mb-6 animate-slideDown delay-150">
            Login to continue to your dashboard
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div class="animate-slideRight delay-200">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                    class="block mt-1 w-full focus:ring-2 focus:ring-blue-500 border-gray-300"
                    type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="animate-slideRight delay-300">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                    class="block mt-1 w-full focus:ring-2 focus:ring-blue-500 border-gray-300"
                    type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember -->
            <div class="flex items-center animate-slideRight delay-400">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                    name="remember">
                <label for="remember_me" class="ml-2 text-sm text-gray-700">
                    Remember me
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-4 animate-fadeIn delay-500">

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:underline hover:text-blue-800"
                       href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif

                <x-primary-button class="ml-3 bg-blue-600 hover:bg-blue-700 hover:scale-105 transition">
                    Log in
                </x-primary-button>
            </div>
        </form>

        <!-- Register Link -->
        <p class="text-center text-gray-600 text-sm mt-6 animate-fadeIn delay-500">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">
                Register here
            </a>
        </p>
    </div>

    <!-- Animations -->
    <style>
        @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
        @keyframes slideDown { from {opacity: 0; transform: translateY(-10px);} to {opacity: 1; transform: translateY(0);} }
        @keyframes slideRight { from {opacity: 0; transform: translateX(-15px);} to {opacity: 1; transform: translateX(0);} }

        .animate-fadeIn { animation: fadeIn .8s ease-in-out; }
        .animate-slideDown { animation: slideDown .7s ease-out; }
        .animate-slideRight { animation: slideRight .7s ease-out; }

        .delay-150 { animation-delay: .15s; }
        .delay-200 { animation-delay: .2s; }
        .delay-300 { animation-delay: .3s; }
        .delay-400 { animation-delay: .4s; }
        .delay-500 { animation-delay: .5s; }
    </style>

</x-guest-layout>
