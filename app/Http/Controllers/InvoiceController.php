<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {

        // $invoice = Invoice::all(); 
        $lastInvoice = Invoice::latest()->first();
        $invoiceNo = 'INV-100' . ($lastInvoice ? $lastInvoice->id + 1 : 1);

        return view('invoice', compact('invoiceNo'));
    }
    public function store(Request $req)
    {

        $validated = $req->validate([
            'restaurant_name' => 'required|string|max:255',
            'invoice_no' => 'required|string|unique:invoices,invoice_no',
            'date' => 'required|date',
            'name' => 'nullable|string',
            'mobile_nu' => 'nullable|numeric|digits_between:10,13',
            'items' => 'required|array',
            'price' => 'required|array',
            'qty' => 'required|array',
            'total' => 'required|array',
            'items.*' => 'required|string|max:255',
            'price.*' => 'required|numeric|min:0',
            'qty.*' => 'required|integer|min:1',
            'total.*' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'subtotal' => 'required|numeric|min:0',
            'gst' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'gTotal' => 'required|numeric|min:0',
        ]);
        // dd($req->all());

        $invoice = Invoice::create([
            'restaurant_name' => $validated['restaurant_name'],
            'invoice_no'      => $validated['invoice_no'],
            'date'            => $validated['date'],
            'name'            => $validated['name'] ?? null,
            'mobile_nu'       => $validated['mobile_nu'] ?? null,
            'items'           => $validated['items'],
            'price'           => $validated['price'],
            'qty'             => $validated['qty'],
            'total'           => $validated['total'],
            'note'            => $validated['note'] ?? null,
            'subtotal'        => $validated['subtotal'],
            'gst'             => $validated['gst'],
            'discount'        => $validated['discount'],
            'gTotal'          => $validated['gTotal'],
        ]);

        return redirect()->route('gen.pdf', ['id' => $invoice->id]);
    }
}
