<x-layouts.admin :title="'Services'">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Services</h2>

        <a href="{{ route('services.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Add Service
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-600 text-white rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded p-4">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b dark:border-gray-700">
                    <th class="py-2">Name</th>
                    <th class="py-2">Price</th>
                    <th class="py-2">Tax</th>
                    <th class="py-2">SKU</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($services as $service)
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2">{{ $service->name }}</td>
                        <td class="py-2">₹{{ $service->unit_price }}</td>
                        <td class="py-2">{{ $service->tax_rate }}%</td>
                        <td class="py-2">{{ $service->sku }}</td>

                        <td class="py-2 flex gap-3">
                            <a href="{{ route('services.edit', $service->id) }}"
                               class="text-blue-500 hover:underline">
                                Edit
                            </a>

                            <form action="{{ route('services.destroy', $service->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>

</x-layouts.admin>
