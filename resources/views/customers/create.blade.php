<x-layouts.admin :title="'Add Customer'">

    <form action="{{ route('customers.store') }}" method="POST"
          class="bg-white dark:bg-gray-800 p-6 rounded shadow w-1/2">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name"
                   class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label>Billing Address</label>
            <textarea name="billing_address"
                      class="w-full border px-3 py-2 rounded"></textarea>
        </div>

        <div class="mb-3">
            <label>Tax ID</label>
            <input type="text" name="tax_id"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Save
        </button>
    </form>

</x-layouts.admin>
