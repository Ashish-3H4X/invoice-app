<x-guest-layout>

    <!-- Heading -->
    <h2 class="text-3xl font-bold text-center mb-2 text-gray-800 animate-slideDown">
        Create Your Account
    </h2>
    <p class="text-center text-gray-600 mb-6 animate-slideDown delay-150">
        Join us and get started
    </p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div class="animate-slideRight delay-200">
            <label class="text-gray-700 text-sm">Full Name</label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   autocomplete="name"
                   class="w-full mt-1 p-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-400 transition bg-white">
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-500" />
        </div>

        <!-- Email -->
        <div class="animate-slideRight delay-250">
            <label class="text-gray-700 text-sm">Email Address</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="username"
                   class="w-full mt-1 p-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-400 transition bg-white">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500" />
        </div>

        <!-- Password -->
        <div class="animate-slideRight delay-300">
            <label class="text-gray-700 text-sm">Password</label>
            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="new-password"
                   class="w-full mt-1 p-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-400 transition bg-white">
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="animate-slideRight delay-350">
            <label class="text-gray-700 text-sm">Confirm Password</label>
            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required
                   autocomplete="new-password"
                   class="w-full mt-1 p-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-400 transition bg-white">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-500" />
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-between mt-6 animate-fadeIn delay-500">

            <a href="{{ route('login') }}"
               class="text-sm text-blue-600 hover:underline hover:text-blue-800 transition">
                Already have an account?
            </a>

            <button class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition transform hover:scale-105">
                Register
            </button>
        </div>

    </form>

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
        .delay-250 { animation-delay: .25s; }
        .delay-300 { animation-delay: .3s; }
        .delay-350 { animation-delay: .35s; }
        .delay-500 { animation-delay: .5s; }
    </style>

</x-guest-layout>
