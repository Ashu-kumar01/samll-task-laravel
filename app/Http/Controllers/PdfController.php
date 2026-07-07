<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generate()
    {
        $invoice = [
            'invoice_no' => 'INV-2026001',
            'date' => now()->format('d-m-Y'),
            'customer' => [
                'name' => 'Ashwani Kumar',
                'email' => 'ashwani@gmail.com',
                'phone' => '9876543210',
                'address' => 'Raipur'
            ],
            'products' => [
                [
                    'name' => 'Laptop',
                    'qty' => 1,
                    'price' => 50000,
                    'gst' => 18
                ],
                [
                    'name' => 'Mouse',
                    'qty' => 2,
                    'price' => 1000,
                    'gst' => 18
                ]
            ]
        ];

        return Pdf::loadView('pdf.user', compact('invoice'))
            ->stream('invoice.pdf');
    }
}
