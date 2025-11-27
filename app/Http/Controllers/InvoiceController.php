<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with('customer');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_no', 'LIKE', '%' . $request->search . '%')
                  ->orWhereHas('customer', function ($q2) use ($request) {
                      $q2->where('name', 'LIKE', '%' . $request->search . '%');
                  });
            });
        }

        if ($request->status === 'paid') {
            $query->where('status', 'paid');
        }

        if ($request->status === 'unpaid') {
            $query->where('status', 'unpaid');
        }

        $invoices = $query->latest()->paginate(10);
        $invoices->appends($request->all());

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::all();
        $services  = Service::all();
        return view('invoices.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'invoice_date'  => 'required|date',
            'due_date'      => 'nullable|date',
            'subtotal'      => 'required|numeric',
            'tax_total'     => 'required|numeric',
            'total'         => 'required|numeric',
            'status'        => 'required|in:paid,unpaid',
            'items'         => 'required|array|min:1',
        ]);

        $invoiceNo = 'INV-' . strtoupper(Str::random(6));

        $invoice = Invoice::create([
            'customer_id'   => $request->customer_id,
            'invoice_no'    => $invoiceNo,
            'invoice_date'  => $request->invoice_date,
            'due_date'      => $request->due_date,
            'subtotal'      => $request->subtotal,
            'tax_total'     => $request->tax_total,
            'total'         => $request->total,
            'status'        => $request->status,
            'notes'         => $request->notes,
        ]);

        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id'  => $invoice->id,
                'service_id'  => $item['service_id'] ?? null,
                'description' => $item['description'],
                'quantity'    => $item['quantity'],
                'unit_price'  => $item['unit_price'],
                'tax_rate'    => $item['tax_rate'],
                'line_total'  => $item['line_total'],
            ]);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function show($id)
    {
        $invoice = Invoice::with(['customer', 'items.service'])->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);
        $customers = Customer::all();
        $services  = Service::all();

        return view('invoices.edit', compact('invoice', 'customers', 'services'));
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        // BLOCK EDIT IF PAID
        if ($invoice->status === 'paid') {
            return redirect()->back()->with('error', 'Paid invoices cannot be edited.');
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date',
            'subtotal' => 'required|numeric',
            'tax_total' => 'required|numeric',
            'total' => 'required|numeric',
            'status' => 'required|in:paid,unpaid',
            'items'  => 'array|min:1',
        ]);

        $invoice->update([
            'customer_id' => $request->customer_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'subtotal' => $request->subtotal,
            'tax_total' => $request->tax_total,
            'total' => $request->total,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        InvoiceItem::where('invoice_id', $invoice->id)->delete();

        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'service_id' => $item['service_id'] ?? null,
                'description' => $item['description'],
                'quantity'    => $item['quantity'],
                'unit_price'  => $item['unit_price'],
                'tax_rate'    => $item['tax_rate'],
                'line_total'  => $item['line_total'],
            ]);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice updated.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        InvoiceItem::where('invoice_id', $invoice->id)->delete();
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted.');
    }

    public function print($id)
    {
        $invoice = Invoice::with(['customer', 'items.service'])->findOrFail($id);
        return view('invoices.print', compact('invoice'));
    }
}
