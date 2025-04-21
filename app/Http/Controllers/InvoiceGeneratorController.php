<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Added Request
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf; // Added Pdf Facade

class InvoiceGeneratorController extends Controller
{
    /**
     * Show the form for creating a new invoice.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // We will create this view in the next step
        return view('invoice.create');
    }

    /**
     * Store a newly created invoice record (temporarily) and generate PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data (optional but recommended)
        //    For simplicity in this example, we'll skip detailed validation.
        $validatedData = $request->all(); // Use all data directly for now

        // 2. Prepare data for the PDF view
        //    This involves structuring the manually entered data.
        //    We'll calculate totals here before passing to the view.

        $lineItems = [];
        $subtotal = 0;
        if (isset($validatedData['items']) && is_array($validatedData['items'])) {
            foreach ($validatedData['items'] as $item) {
                $quantity = isset($item['quantity']) ? floatval($item['quantity']) : 0;
                $unit_price = isset($item['unit_price']) ? floatval($item['unit_price']) : 0;
                $lineTotal = $quantity * $unit_price;
                $lineItems[] = [
                    'description' => $item['description'] ?? '',
                    'quantity' => $quantity,
                    'unit_price' => $unit_price,
                    'line_total' => $lineTotal,
                ];
                $subtotal += $lineTotal;
            }
        }

        $taxRate = isset($validatedData['tax_rate']) ? floatval($validatedData['tax_rate']) : 0;
        $taxAmount = ($subtotal * $taxRate) / 100;
        $grandTotal = $subtotal + $taxAmount;

        $invoiceData = [
            'sender_name' => $validatedData['sender_name'] ?? '',
            'sender_address' => $validatedData['sender_address'] ?? '',
            'sender_phone' => $validatedData['sender_phone'] ?? '',
            'sender_email' => $validatedData['sender_email'] ?? '',
            'customer_name' => $validatedData['customer_name'] ?? '',
            'customer_address' => $validatedData['customer_address'] ?? '',
            'customer_email' => $validatedData['customer_email'] ?? '', // Added customer email
            'invoice_number' => $validatedData['invoice_number'] ?? 'INV-' . time(),
            'issue_date' => $validatedData['issue_date'] ?? date('Y-m-d'),
            'due_date' => $validatedData['due_date'] ?? date('Y-m-d'),
            'items' => $lineItems,
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'grand_total' => $grandTotal,
            'notes' => $validatedData['notes'] ?? '',
        ];

        // 3. Load the PDF view with the data
        //    We will create 'invoice.pdf_template' view next.
        $pdf = Pdf::loadView('invoice.pdf_template', $invoiceData);

        // 4. Generate a filename
        $filename = 'invoice-' . ($invoiceData['invoice_number'] ?: time()) . '.pdf';

        // 5. Download the PDF
        return $pdf->download($filename);

        // Note: No data is saved to a database here, fulfilling the requirement.
        // Temporary storage (session/local) for listing recent invoices is not implemented in this basic version.
    }
}