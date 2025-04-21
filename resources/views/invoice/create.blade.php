<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Simple Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- If you have vite setup, replace above with: -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <style>
        /* Simple style for removing items */
        .remove-item-btn {
            cursor: pointer;
            color: red;
            font-weight: bold;
            margin-left: 10px;
        }
    </style>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Create Simple Invoice</h1>

        <form action="{{ route('invoice.store') }}" method="POST" id="invoice-form">
            @csrf

            <!-- Sender Details -->
            <fieldset class="border p-4 mb-6">
                <legend class="font-semibold">Your Details (Sender)</legend>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="sender_name" class="block text-sm font-medium text-gray-700">Name/Company</label>
                        <input type="text" name="sender_name" id="sender_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="sender_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="sender_phone" id="sender_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label for="sender_address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea name="sender_address" id="sender_address" rows="2" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    </div>
                     <div>
                        <label for="sender_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="sender_email" id="sender_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
            </fieldset>

            <!-- Customer Details -->
            <fieldset class="border p-4 mb-6">
                <legend class="font-semibold">Customer Details (Bill To)</legend>
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Name/Company</label>
                        <input type="text" name="customer_name" id="customer_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                     <div>
                        <label for="customer_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="customer_email" id="customer_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label for="customer_address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea name="customer_address" id="customer_address" rows="2" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    </div>
                </div>
            </fieldset>

            <!-- Invoice Meta -->
            <fieldset class="border p-4 mb-6">
                <legend class="font-semibold">Invoice Details</legend>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                        <input type="text" name="invoice_number" id="invoice_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="issue_date" class="block text-sm font-medium text-gray-700">Issue Date</label>
                        <input type="date" name="issue_date" id="issue_date" required value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                        <input type="date" name="due_date" id="due_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
            </fieldset>

            <!-- Line Items -->
            <fieldset class="border p-4 mb-6">
                <legend class="font-semibold">Items</legend>
                <div id="line-items-container">
                    <!-- Initial Item Row -->
                    <div class="line-item grid grid-cols-1 md:grid-cols-12 gap-2 mb-2 items-center">
                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <input type="text" name="items[0][description]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="items[0][quantity]" required value="1" min="0" step="any" class="item-calc mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Unit Price</label>
                            <input type="number" name="items[0][unit_price]" required value="0.00" min="0" step="0.01" class="item-calc mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Line Total</label>
                            <span class="line-total-display mt-1 block w-full sm:text-sm p-2 bg-gray-100 rounded">0.00</span>
                        </div>
                        <div class="md:col-span-1 flex items-end justify-center">
                            <!-- Remove button added dynamically -->
                        </div>
                    </div>
                </div>
                <button type="button" id="add-item-btn" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Add Item</button>
            </fieldset>

            <!-- Totals -->
            <div class="flex justify-end mb-6">
                <div class="w-full md:w-1/3">
                    <div class="flex justify-between py-1">
                        <span class="font-medium">Subtotal:</span>
                        <span id="subtotal-display">0.00</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="font-medium">Tax Rate (%):</span>
                        <input type="number" name="tax_rate" id="tax-rate" value="0" min="0" step="0.01" class="tax-calc w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-right">
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="font-medium">Tax Amount:</span>
                        <span id="tax-amount-display">0.00</span>
                    </div>
                    <div class="flex justify-between py-2 border-t mt-2">
                        <span class="font-bold text-lg">Grand Total:</span>
                        <span id="grand-total-display" class="font-bold text-lg">0.00</span>
                    </div>
                </div>
            </div>

             <!-- Notes -->
            <fieldset class="border p-4 mb-6">
                <legend class="font-semibold">Notes / Terms</legend>
                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
            </fieldset>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">Generate & Download PDF</button>
            </div>
        </form>
    </div>

    <script>
        let itemIndex = 1; // Start index for next item

        // Function to calculate line total for a given row
        function calculateLineTotal(row) {
            const quantityInput = row.querySelector('input[name*="[quantity]"]');
            const priceInput = row.querySelector('input[name*="[unit_price]"]');
            const totalDisplay = row.querySelector('.line-total-display');

            const quantity = parseFloat(quantityInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;
            const lineTotal = quantity * price;

            totalDisplay.textContent = lineTotal.toFixed(2);
            calculateTotals(); // Recalculate grand totals whenever a line item changes
        }

        // Function to calculate subtotal, tax, and grand total
        function calculateTotals() {
            const itemRows = document.querySelectorAll('.line-item');
            let subtotal = 0;
            itemRows.forEach(row => {
                const totalDisplay = row.querySelector('.line-total-display');
                subtotal += parseFloat(totalDisplay.textContent) || 0;
            });

            const taxRateInput = document.getElementById('tax-rate');
            const taxRate = parseFloat(taxRateInput.value) || 0;
            const taxAmount = (subtotal * taxRate) / 100;
            const grandTotal = subtotal + taxAmount;

            document.getElementById('subtotal-display').textContent = subtotal.toFixed(2);
            document.getElementById('tax-amount-display').textContent = taxAmount.toFixed(2);
            document.getElementById('grand-total-display').textContent = grandTotal.toFixed(2);
        }

        // Add new item row
        document.getElementById('add-item-btn').addEventListener('click', () => {
            const container = document.getElementById('line-items-container');
            const newItemRow = document.createElement('div');
            newItemRow.classList.add('line-item', 'grid', 'grid-cols-1', 'md:grid-cols-12', 'gap-2', 'mb-2', 'items-center');
            newItemRow.innerHTML = `
                <div class="md:col-span-5">
                    <input type="text" name="items[${itemIndex}][description]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="md:col-span-2">
                    <input type="number" name="items[${itemIndex}][quantity]" required value="1" min="0" step="any" class="item-calc mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="md:col-span-2">
                    <input type="number" name="items[${itemIndex}][unit_price]" required value="0.00" min="0" step="0.01" class="item-calc mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="md:col-span-2">
                    <span class="line-total-display mt-1 block w-full sm:text-sm p-2 bg-gray-100 rounded">0.00</span>
                </div>
                <div class="md:col-span-1 flex items-end justify-center">
                    <span class="remove-item-btn" onclick="removeItem(this)">X</span>
                </div>
            `;
            container.appendChild(newItemRow);

            // Add event listeners to the new row's inputs
            newItemRow.querySelectorAll('.item-calc').forEach(input => {
                input.addEventListener('input', () => calculateLineTotal(newItemRow));
            });

            itemIndex++; // Increment index for the next item
        });

        // Function to remove an item row
        function removeItem(button) {
            const row = button.closest('.line-item');
            // Prevent removing the last item row
            if (document.querySelectorAll('.line-item').length > 1) {
                row.remove();
                calculateTotals(); // Recalculate totals after removing an item
            } else {
                alert("You must have at least one item.");
            }
        }

        // Initial calculation and event listeners for the first row and tax
        document.addEventListener('DOMContentLoaded', () => {
            const initialRow = document.querySelector('.line-item');
            initialRow.querySelectorAll('.item-calc').forEach(input => {
                input.addEventListener('input', () => calculateLineTotal(initialRow));
            });

            document.getElementById('tax-rate').addEventListener('input', calculateTotals);

            // Add remove button functionality to the initial row if needed (only if more than one row exists initially, which isn't the case here)
            // For consistency, let's add it dynamically even to the first row if others are added.
             if (document.querySelectorAll('.line-item').length === 1) {
                 const firstRemoveBtnContainer = initialRow.querySelector('.md\\:col-span-1');
                 // Check if button already exists to avoid duplicates on potential reloads/scripts running twice
                 if (!firstRemoveBtnContainer.querySelector('.remove-item-btn')) {
                    firstRemoveBtnContainer.innerHTML = '<span class="remove-item-btn" onclick="removeItem(this)">X</span>';
                 }
            }

            calculateLineTotal(initialRow); // Initial calculation for the first row
        });

    </script>
</body>
</html>