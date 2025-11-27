<x-layouts.admin :title="'Customers'">

    <div class="flex justify-between mb-4">
        <input type="text" placeholder="Search..."
               class="border px-3 py-2 rounded w-1/3">

        <a href="{{ route('customers.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded">
            + Add Customer
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Tax ID</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($customers as $customer)
                <tr class="border-b">
                    <td class="py-2">{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->tax_id }}</td>
                    <td class="flex gap-2">
                        <a href="{{ route('customers.edit', $customer->id) }}"
                           class="text-blue-500">Edit</a>

                        <form action="{{ route('customers.destroy', $customer->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete customer?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $customers->links() }}
        </div>
    </div>

</x-layouts.admin>
