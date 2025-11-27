<x-guest-layout>

    <!-- Heading -->
    <h2 class="text-3xl font-bold text-center mb-2 text-gray-800 animate-slideDown">
        Forgot Password?
    </h2>

    <p class="text-center text-gray-600 mb-6 animate-slideDown delay-150">
        Enter your email and we'll send you a reset link.
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div class="animate-slideRight delay-200">
            <label class="text-gray-700 text-sm">Email Address</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   class="w-full mt-1 p-2 rounded border border-gray-300 focus:ring-2 focus:ring-blue-400 transition bg-white">

            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500" />
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end mt-6 animate-fadeIn delay-400">
            <button class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition transform hover:scale-105">
                Email Reset Link
            </button>
        </div>

        <!-- Back to login -->
        <p class="text-center mt-4 text-sm text-gray-600 animate-fadeIn delay-500">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline hover:text-blue-800">
                Back to Login
            </a>
        </p>
    </form>

    <!-- Animation Styles -->
    <style>
        @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
        @keyframes slideDown { from {opacity: 0; transform: translateY(-10px);} to {opacity: 1; transform: translateY(0);} }
        @keyframes slideRight { from {opacity: 0; transform: translateX(-15px);} to {opacity: 1; transform: translateX(0);} }

        .animate-fadeIn { animation: fadeIn .8s ease-in-out; }
        .animate-slideDown { animation: slideDown .7s ease-out; }
        .animate-slideRight { animation: slideRight .7s ease-out; }

        .delay-150 { animation-delay: .15s; }
        .delay-200 { animation-delay: .2s; }
        .delay-400 { animation-delay: .4s; }
        .delay-500 { animation-delay: .5s; }
    </style>

</x-guest-layout>
