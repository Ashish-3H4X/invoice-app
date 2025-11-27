<x-layouts.admin :title="'Create Invoice'">

    <h1 class="text-2xl font-bold mb-6">Create Invoice</h1>

    <form action="{{ route('invoices.store') }}" method="POST" id="invoiceForm">
        @csrf

        <!-- CUSTOMER + DATES + STATUS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

            <!-- Customer -->
            <div>
                <label class="block mb-1 font-semibold">Customer</label>
                <select name="customer_id" class="w-full p-2 border rounded" required>
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Invoice Date -->
            <div>
                <label class="block mb-1 font-semibold">Invoice Date</label>
                <input type="date" name="invoice_date" class="w-full p-2 border rounded"
                       value="{{ date('Y-m-d') }}" required>
            </div>

            <!-- Due Date -->
            <div>
                <label class="block mb-1 font-semibold">Due Date</label>
                <input type="date" name="due_date" class="w-full p-2 border rounded">
            </div>

            <!-- STATUS -->
            <div>
                <label class="block mb-1 font-semibold">Status</label>
                <select name="status" class="w-full p-2 border rounded" required>
                    <option value="unpaid">Unpaid</option>
                    <option value="paid">Paid</option>
                </select>
            </div>

        </div>

        <!-- INVOICE ITEMS -->
        <div class="mb-6">
            <table class="w-full bg-white rounded shadow" id="itemsTable">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="p-2">Service</th>
                        <th class="p-2">Description</th>
                        <th class="p-2 w-20">Qty</th>
                        <th class="p-2 w-32">Unit Price</th>
                        <th class="p-2 w-20">Tax %</th>
                        <th class="p-2 w-32">Total</th>
                        <th class="p-2 w-10">X</th>
                    </tr>
                </thead>

                <tbody id="itemRows"></tbody>
            </table>

            <button type="button" id="addItem"
              class="mt-3 px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700">
              + Add Item
            </button>
        </div>

        <!-- TOTALS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div></div><div></div>

            <div class="p-4 bg-white rounded shadow">
                <div class="flex justify-between mb-2">
                    <span>Subtotal:</span>
                    <span id="subtotalLabel">₹0.00</span>
                </div>

                <div class="flex justify-between mb-2">
                    <span>Tax:</span>
                    <span id="taxLabel">₹0.00</span>
                </div>

                <div class="flex justify-between font-bold text-lg">
                    <span>Total:</span>
                    <span id="totalLabel">₹0.00</span>
                </div>

                <input type="hidden" name="subtotal">
                <input type="hidden" name="tax_total">
                <input type="hidden" name="total">
            </div>
        </div>

        <!-- Notes -->
        <div class="mb-6">
            <label class="block mb-1 font-semibold">Notes (optional)</label>
            <textarea name="notes" rows="4" class="w-full p-2 border rounded"></textarea>
        </div>

        <button class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Save Invoice
        </button>

    </form>

</x-layouts.admin>


<!-- ========================= JS LOGIC ========================= -->

<script>
    let services = @json($services);

    function addRow() {
        let index = document.querySelectorAll("#itemRows tr").length;

        let row = `
        <tr class="border-b">

            <td class="p-2">
                <select name="items[${index}][service_id]" 
                        class="serviceSelect w-full p-2 border rounded">
                    <option value="">Select</option>
                    ${services.map(s => `<option value="${s.id}">${s.name}</option>`).join('')}
                </select>
            </td>

            <td class="p-2">
                <input name="items[${index}][description]"
                       type="text"
                       class="desc w-full p-2 border rounded">
            </td>

            <td class="p-2">
                <input name="items[${index}][quantity]"
                       type="number"
                       class="qty w-full p-2 border rounded"
                       value="1" min="1">
            </td>

            <td class="p-2">
                <input name="items[${index}][unit_price]"
                       type="number"
                       class="price w-full p-2 border rounded"
                       step="0.01">
            </td>

            <td class="p-2">
                <input name="items[${index}][tax_rate]"
                       type="number"
                       class="tax w-full p-2 border rounded"
                       value="0" step="0.01">
            </td>

            <td class="p-2">
                <input name="items[${index}][line_total]"
                       type="text"
                       class="lineTotal w-full p-2 border rounded bg-gray-200"
                       readonly>
            </td>

            <td class="p-2 text-center">
                <button type="button" class="removeRow text-red-500 font-bold">X</button>
            </td>

        </tr>`;

        document.querySelector("#itemRows").insertAdjacentHTML('beforeend', row);
        attachEvents();
    }

    function attachEvents() {
        document.querySelectorAll(".serviceSelect").forEach(select => {
            select.onchange = function () {
                let selected = services.find(s => s.id == this.value);
                let row = this.closest("tr");

                if (selected) {
                    row.querySelector(".price").value = selected.unit_price;
                    row.querySelector(".tax").value = selected.tax_rate;
                }
                calculateTotals();
            };
        });

        document.querySelectorAll(".qty, .price, .tax").forEach(input => {
            input.oninput = calculateTotals;
        });

        document.querySelectorAll(".removeRow").forEach(btn => {
            btn.onclick = function () {
                this.closest("tr").remove();
                calculateTotals();
            };
        });
    }

    function calculateTotals() {
        let subtotal = 0, taxTotal = 0;

        document.querySelectorAll("#itemRows tr").forEach(row => {
            let qty = parseFloat(row.querySelector(".qty").value) || 0;
            let price = parseFloat(row.querySelector(".price").value) || 0;
            let tax = parseFloat(row.querySelector(".tax").value) || 0;

            let line = qty * price;
            let lineTax = line * (tax / 100);

            row.querySelector(".lineTotal").value = (line + lineTax).toFixed(2);

            subtotal += line;
            taxTotal += lineTax;
        });

        let total = subtotal + taxTotal;

        document.getElementById("subtotalLabel").innerText = "₹" + subtotal.toFixed(2);
        document.getElementById("taxLabel").innerText = "₹" + taxTotal.toFixed(2);
        document.getElementById("totalLabel").innerText = "₹" + total.toFixed(2);

        document.querySelector("input[name='subtotal']").value = subtotal;
        document.querySelector("input[name='tax_total']").value = taxTotal;
        document.querySelector("input[name='total']").value = total;
    }

    document.getElementById("addItem").onclick = addRow;

    addRow();
</script>
