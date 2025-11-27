<x-layouts.admin :title="'Add Service'">

    <h2 class="text-2xl font-semibold mb-6">Add New Service</h2>

    <form action="{{ route('services.store') }}" method="POST" class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded shadow">
        @csrf

        <div>
            <label class="block font-medium mb-1">Name</label>
            <input type="text" name="name" class="w-full p-2 border rounded dark:bg-gray-700" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Description</label>
            <textarea name="description" class="w-full p-2 border rounded dark:bg-gray-700"></textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Unit Price</label>
            <input type="number" step="0.01" name="unit_price" class="w-full p-2 border rounded dark:bg-gray-700" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Tax Rate (%)</label>
            <input type="number" step="0.01" name="tax_rate" class="w-full p-2 border rounded dark:bg-gray-700">
        </div>

        <div>
            <label class="block font-medium mb-1">SKU</label>
            <input type="text" name="sku" class="w-full p-2 border rounded dark:bg-gray-700">
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Save Service
        </button>
    </form>

</x-layouts.admin>
