<x-layouts.admin :title="'Edit Customer'">

    <form action="{{ route('customers.update', $customer->id) }}" method="POST"
          class="bg-white dark:bg-gray-800 p-6 rounded shadow w-1/2">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name"
                   value="{{ $customer->name }}"
                   class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
                   value="{{ $customer->email }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone"
                   value="{{ $customer->phone }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label>Billing Address</label>
            <textarea name="billing_address"
                      class="w-full border px-3 py-2 rounded">{{ $customer->billing_address }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tax ID</label>
            <input type="text" name="tax_id"
                   value="{{ $customer->tax_id }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Update
        </button>
    </form>

</x-layouts.admin>
