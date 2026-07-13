<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generate($id)
    {
        $invoices = Invoice::findOrFail($id);

        $invoiceData = [
            'invoice_no' => $invoices->invoice_no,
            'date'       => $invoices->date,

            'restaurant' => [
                'name'  => $invoices->restaurant_name,
                'phone' => $invoices->mobile_nu,
            ],

            'customer' => [
                'name'    => $invoices->name,
                'phone'   => $invoices->mobile_nu,
                'email'   => '',
                'address' => '',
            ],

            'products' => [],
        ];

        foreach ($invoices->items as $index => $item) {
            $invoiceData['products'][] = [
                'name'  => $item,
                'qty'   => $invoices->qty[$index],
                'price' => $invoices->price[$index],
                'gst'   => $invoices->gst,
            ];
        }

        return Pdf::loadView('pdf.user', compact('invoices'))
            ->stream('ledger')
            ->stream('invoice.pdf');
    }
}
