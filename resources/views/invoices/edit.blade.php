<x-layouts.admin :title="'Edit Invoice'">

@php
$isLocked = $invoice->status === 'paid';
@endphp

<h1 class="text-2xl font-bold mb-4">Edit Invoice</h1>

@if(session('error'))
<div class="p-3 bg-red-100 text-red-700 rounded mb-4">
    {{ session('error') }}
</div>
@endif

<form method="POST" action="{{ route('invoices.update', $invoice->id) }}">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-4 mb-4">
        
        <div>
            <label class="block font-medium">Customer</label>
            <select name="customer_id" class="w-full border p-2 rounded" {{ $isLocked ? 'disabled' : '' }}>
                @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded" {{ $isLocked ? 'disabled' : '' }}>
                <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>

            @if($isLocked)
                <input type="hidden" name="status" value="paid">
            @endif
        </div>
    </div>

    <!-- DATES -->
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label>Invoice Date</label>
            <input type="date" name="invoice_date"
                   class="w-full border p-2 rounded"
                   value="{{ $invoice->invoice_date }}"
                   {{ $isLocked ? 'disabled' : '' }}>
        </div>

        <div>
            <label>Due Date</label>
            <input type="date" name="due_date"
                   class="w-full border p-2 rounded"
                   value="{{ $invoice->due_date }}"
                   {{ $isLocked ? 'disabled' : '' }}>
        </div>
    </div>

    <!-- ITEMS TABLE -->
    <h2 class="font-semibold text-lg mb-2">Items</h2>

    <table class="w-full border mb-6">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Qty</th>
                <th class="p-2 border">Price</th>
                <th class="p-2 border">Tax%</th>
                <th class="p-2 border">Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($invoice->items as $index => $item)
            <tr>
                <td class="p-2 border">
                    <input type="text" name="items[{{ $index }}][description]"
                           value="{{ $item->description }}"
                           class="w-full border p-2 rounded"
                           {{ $isLocked ? 'disabled' : '' }}>
                </td>

                <td class="p-2 border">
                    <input type="number" name="items[{{ $index }}][quantity]"
                           value="{{ $item->quantity }}"
                           class="w-full border p-2 rounded"
                           {{ $isLocked ? 'disabled' : '' }}>
                </td>

                <td class="p-2 border">
                    <input type="number" name="items[{{ $index }}][unit_price]"
                           value="{{ $item->unit_price }}"
                           class="w-full border p-2 rounded"
                           {{ $isLocked ? 'disabled' : '' }}>
                </td>

                <td class="p-2 border">
                    <input type="number" name="items[{{ $index }}][tax_rate]"
                           value="{{ $item->tax_rate }}"
                           class="w-full border p-2 rounded"
                           {{ $isLocked ? 'disabled' : '' }}>
                </td>

                <td class="p-2 border">
                    <input type="number" name="items[{{ $index }}][line_total]"
                           value="{{ $item->line_total }}"
                           class="w-full border p-2 rounded"
                           readonly>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- SUMMARY -->
    <div class="bg-white p-4 rounded shadow mb-6">
        <label>Subtotal</label>
        <input type="number" name="subtotal" class="w-full border p-2 rounded mb-3"
               value="{{ $invoice->subtotal }}" {{ $isLocked ? 'disabled' : '' }}>

        <label>Tax Total</label>
        <input type="number" name="tax_total" class="w-full border p-2 rounded mb-3"
               value="{{ $invoice->tax_total }}" {{ $isLocked ? 'disabled' : '' }}>

        <label>Total</label>
        <input type="number" name="total" class="w-full border p-2 rounded"
               value="{{ $invoice->total }}" {{ $isLocked ? 'disabled' : '' }}>
    </div>

    <!-- NOTES -->
    <div class="mb-4">
        <label>Notes</label>
        <textarea name="notes" class="w-full border p-2 rounded" rows="3"
                  {{ $isLocked ? 'disabled' : '' }}>
            {{ $invoice->notes }}
        </textarea>
    </div>

    <!-- UPDATE BUTTON (hidden when paid) -->
    @if(!$isLocked)
    <button class="px-6 py-2 bg-blue-600 text-white rounded">Update Invoice</button>
    @endif

    <a href="{{ route('invoices.index') }}" 
       class="px-6 py-2 bg-gray-600 text-white rounded ml-3">
        Back
    </a>

</form>

</x-layouts.admin>
