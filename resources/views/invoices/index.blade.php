<x-layouts.admin :title="'Invoices'">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Invoices</h1>

        <a href="{{ route('invoices.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow">
            + New Invoice
        </a>
    </div>

    <!-- SEARCH + FILTERS -->
    <div class="bg-white p-4 rounded-lg shadow mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">

        <!-- Search -->
        <form method="GET" action="" class="flex items-center gap-3 w-full md:w-1/3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search invoices..."
                   class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300">
            <button class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Search</button>
        </form>

        <!-- Filters -->
        <div class="flex gap-2">
            <a href="{{ route('invoices.index') }}"
               class="px-3 py-2 rounded-lg border {{ request('status') ? 'bg-white' : 'bg-blue-600 text-white' }}">
                All
            </a>

            <a href="{{ route('invoices.index', ['status' => 'paid']) }}"
               class="px-3 py-2 rounded-lg border {{ request('status')=='paid' ? 'bg-green-600 text-white' : 'bg-white' }}">
                Paid
            </a>

            <a href="{{ route('invoices.index', ['status' => 'unpaid']) }}"
               class="px-3 py-2 rounded-lg border {{ request('status')=='unpaid' ? 'bg-red-600 text-white' : 'bg-white' }}">
                Unpaid
            </a>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-lg shadow overflow-hidden">

        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Invoice No</th>
                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($invoices as $invoice)
                    <tr class="border-b hover:bg-gray-50 transition">

                        <!-- Invoice No -->
                        <td class="p-3 font-medium">{{ $invoice->invoice_no }}</td>

                        <!-- Customer -->
                        <td class="p-3">{{ $invoice->customer->name }}</td>

                        <!-- Total -->
                        <td class="p-3">₹{{ number_format($invoice->total, 2) }}</td>

                        <!-- STATUS BADGE (ANIMATED) -->
                        <td class="p-3">
                            @if ($invoice->status === 'paid')
                                <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full animate-fade">
                                    Paid
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full animate-fade">
                                    Unpaid
                                </span>
                            @endif
                        </td>

                        <!-- Date -->
                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}
                        </td>

                        <!-- ACTION BUTTONS -->
                        <td class="p-3 flex gap-4">

                            <!-- VIEW -->
                            <a href="{{ route('invoices.show', $invoice->id) }}"
                               class="text-blue-600 hover:underline">
                                View
                            </a>

                            <!-- PRINT -->
                            <a href="{{ route('invoices.show', $invoice->id) }}?print=1"
                               target="_blank"
                               class="text-yellow-600 hover:underline">
                                Print
                            </a>

                            <!-- PDF DOWNLOAD -->
                            <a href="{{ route('invoices.show', $invoice->id) }}?download=pdf"
                               class="text-purple-600 hover:underline">
                                PDF
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('invoices.edit', $invoice->id) }}"
                               class="text-green-600 hover:underline">
                                Edit
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this invoice?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            No invoices found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $invoices->links() }}
    </div>

</x-layouts.admin>

<!-- SIMPLE BADGE ANIMATION -->
<style>
    .animate-fade {
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
</style>
