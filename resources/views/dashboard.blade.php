<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <!-- GREETING -->
            <div class="bg-white dark:bg-gray-800 border rounded-xl p-6 shadow-sm">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Hello, {{ auth()->user()->name }}
                </h1>
                <p class="text-gray-600 dark:text-gray-300 text-sm mt-1">
                    Here’s a quick overview of your business.
                </p>
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">

                <div class="bg-white dark:bg-gray-800 border rounded-xl p-5 shadow-sm">
                    <p class="text-gray-500 text-sm">Customers</p>
                    <h2 class="text-3xl font-semibold mt-2">{{ $totalCustomers }}</h2>
                </div>

                <div class="bg-white dark:bg-gray-800 border rounded-xl p-5 shadow-sm">
                    <p class="text-gray-500 text-sm">Services</p>
                    <h2 class="text-3xl font-semibold mt-2">{{ $totalServices }}</h2>
                </div>

                <div class="bg-white dark:bg-gray-800 border rounded-xl p-5 shadow-sm">
                    <p class="text-gray-500 text-sm">Invoices</p>
                    <h2 class="text-3xl font-semibold mt-2">{{ $totalInvoices }}</h2>
                </div>

                <div class="bg-white dark:bg-gray-800 border rounded-xl p-5 shadow-sm">
                    <p class="text-gray-500 text-sm">Paid Invoices</p>
                    <h2 class="text-3xl font-semibold text-green-600 mt-2">{{ $paidInvoices }}</h2>
                </div>

            </div>

            <!-- QUICK ACTIONS -->
            <div class="mt-10">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Quick Actions
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                    <a href="{{ route('customers.index') }}"
                       class="bg-white dark:bg-gray-800 border rounded-xl p-5 text-center shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition text-gray-800 dark:text-gray-200 font-medium">
                        Customers
                    </a>

                    <a href="{{ route('services.index') }}"
                       class="bg-white dark:bg-gray-800 border rounded-xl p-5 text-center shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition text-gray-800 dark:text-gray-200 font-medium">
                        Services
                    </a>

                    <a href="{{ route('invoices.create') }}"
                       class="bg-blue-600 text-white rounded-xl p-5 text-center shadow-sm hover:bg-blue-700 transition font-medium">
                        New Invoice
                    </a>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
