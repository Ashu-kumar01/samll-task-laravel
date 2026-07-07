<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice');
    }
    public function store(Request $req)
    {

        $validated = $req->validator([
            'restaurant_name' => 'required|string|max:255',
            'invoice_no' => 'required|string|max:255',
            'date' => 'required|date',
            'name' => 'nullable|string',
            'mobile_nu' => 'nullable|string|min:15',
            'items' => 'required|array|min:1',
            'price' => 'required|array',
            'qty' => 'required|array',
            'total' => 'required|array',
            'note' => 'nullable|string',
            'subtotal' => 'required|numeric',
            'gst' => 'required|numeric',
            'discount' => 'required|numeric',
            'gTotal' => 'required|numeric',
        ]);

        $user = Invoice::create([
            $restaurant_name = $req->restaurant_name,
            $invoice_no = $req->invoice_no,
            $date = $req->date,
            $name = $req->name,
            $mobile_nu = $req->mobile_nu,
            $items = $req->items,
            $price = $req->price,
            $qty = $req->qty,
            $total = $req->total,
            $note = $req->note,
            $subtotal = $req->subtotal,
            $gst = $req->gst,
            $discount = $req->discount,
            $gTotal = $req->gTotal
        ]);

        

        // dd($req->all());
        return view('invoice');
    }
}
