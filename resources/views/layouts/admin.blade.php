<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

@php
    $user = auth()->user();
    $hour = now()->format('H');

    if ($hour < 12) {
        $greet = "Good Morning";
    } elseif ($hour < 17) {
        $greet = "Good Afternoon";
    } else {
        $greet = "Good Evening";
    }
@endphp

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-md">
        <div class="p-4 text-xl font-bold border-b">
            Invoice System
        </div>

        <nav class="p-4 space-y-2 text-gray-700">
            <a href="/dashboard" class="block px-3 py-2 rounded hover:bg-gray-200">Dashboard</a>
            <a href="{{ route('customers.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Customers</a>
            <a href="{{ route('services.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Services</a>
            <a href="{{ route('invoices.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Invoices</a>
            <a href="{{ route('payments.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Payments</a>
            <a href="{{ route('settings.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Settings</a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1">

        <!-- TOP NAVBAR WITH GREETING -->
        <header class="w-full bg-white shadow px-6 py-4 flex items-center justify-between">

            <h1 class="text-lg font-semibold">{{ $title ?? 'Page' }}</h1>

            <div class="flex items-center gap-4">

                <!-- Greeting Text -->
                @if($user)
                    <div class="text-right">
                        <p class="text-sm text-gray-500">{{ $greet }},</p>
                        <p class="font-semibold text-gray-700">{{ $user->name }}</p>
                    </div>
                @endif

                <!-- Avatar -->
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-200 text-blue-700 font-semibold">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>

                <!-- Logout -->
                @if($user)
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-3 py-1 rounded bg-gray-100 hover:bg-gray-200 border text-sm">
                            Logout
                        </button>
                    </form>
                @endif

            </div>
        </header>

        <!-- PAGE CONTENT -->
        <section class="p-6">
            {{ $slot }}
        </section>

        <!-- FOOTER -->
        <footer class="text-center py-4 text-sm text-gray-500">
            Invoice System — Built by Rahul Verma © 2025
        </footer>

    </main>
</div>

</body>
</html>
