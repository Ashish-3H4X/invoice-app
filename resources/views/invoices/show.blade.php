<x-layouts.admin :title="'Invoice Details'">

    <h1 class="text-2xl font-bold mb-6">Invoice Details</h1>

    <!-- INVOICE BASIC INFO -->
    <div class="bg-white p-5 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Invoice Information</h2>

        <p><strong>Invoice No:</strong> {{ $invoice->invoice_no }}</p>
        <p><strong>Customer:</strong> {{ $invoice->customer->name }}</p>
        <p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>
        <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p>

        <p class="mt-2">
            <strong>Status:</strong>
            @if($invoice->status == 'paid')
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    Paid
                </span>
            @else
                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold">
                    Unpaid
                </span>
            @endif
        </p>
    </div>

    <!-- INVOICE ITEMS -->
    <div class="bg-white p-5 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Invoice Items</h2>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">Description</th>
                    <th class="p-3 border">Qty</th>
                    <th class="p-3 border">Unit Price</th>
                    <th class="p-3 border">Tax %</th>
                    <th class="p-3 border">Total</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($invoice->items as $item)
                    <tr>
                        <td class="p-3 border">{{ $item->description }}</td>
                        <td class="p-3 border">{{ $item->quantity }}</td>
                        <td class="p-3 border">₹{{ number_format($item->unit_price, 2) }}</td>
                        <td class="p-3 border">{{ $item->tax_rate }}%</td>
                        <td class="p-3 border">₹{{ number_format($item->line_total, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">
                            No items found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- SUMMARY -->
    <div class="bg-white p-5 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Summary</h2>

        <p><strong>Subtotal:</strong> ₹{{ number_format($invoice->subtotal, 2) }}</p>
        <p><strong>Tax:</strong> ₹{{ number_format($invoice->tax_total, 2) }}</p>
        <p><strong>Total:</strong> ₹{{ number_format($invoice->total, 2) }}</p>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="flex gap-3">

        <a href="{{ route('invoices.print', $invoice->id) }}"
           target="_blank"
           class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
           Print Invoice
        </a>

        <a href="{{ route('invoices.edit', $invoice->id) }}"
           class="px-5 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
           Edit Invoice
        </a>

        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this invoice?');">
            @csrf
            @method('DELETE')
            <button class="px-5 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Delete Invoice
            </button>
        </form>

        <a href="{{ route('invoices.index') }}"
           class="px-5 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
           Back
        </a>

    </div>

</x-layouts.admin>
