<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Invoice</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .invoice-box {
            max-width: 1200px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .table input {
            min-width: 90px;
        }

        .total-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="invoice-box">
            <form action="{{ route('invoice.store') }}" method="post">
                @csrf

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold">🍽 Restaurant Invoice</h2>
                        <small>Create New Invoice</small>
                    </div>

                    <button type="submit" onclick="" class="btn btn-primary no-print">
                        Print Invoice
                    </button>
                </div>

                <hr>

                <div class="row">

                    <div class="col-md-6">

                        <h5>Restaurant Details</h5>

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="restaurant_name"
                                value="Food Palace Restaurant" readonly>
                        </div>



                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="mobile_nu" class="form-control">
                        </div>


                    </div>

                    <div class="col-md-6">

                        <h5>Invoice Details</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Invoice No.</label>
                                <input type="text" class="form-control" name="invoice_no" value="INV-1001">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Date</label>
                                <input type="date" class="form-control" name="date" value=""
                                    id="currentDate" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>


                        </div>

                    </div>


                </div>

                <hr>

                <h5 class="mb-3">Order Items</h5>

                <div class="table-responsive">

                    <table class="table table-bordered align-middle" id="invoiceTable">

                        <thead class="table-dark">

                            <tr>
                                <th width="35%">Item</th>
                                <th width="15%">Price</th>
                                <th width="15%">Qty</th>
                                <th width="15%">Total</th>
                                <th width="10%" class="no-print">Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>
                                    <input type="text" class="form-control item" name="items[]">
                                </td>

                                <td>
                                    <input type="number" class="form-control price" value="0" name='price[]'>
                                </td>

                                <td>
                                    <input type="number" class="form-control qty" value="1" name="qty[]">
                                </td>

                                <td>
                                    <input type="number" class="form-control total" readonly name="total[]">
                                </td>

                                <td class="text-center no-print">
                                    <button class="btn btn-danger removeRow">
                                        ✖
                                    </button>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

                <button class="btn btn-success no-print" type="button" id="addRow">
                    + Add Item
                </button>

                <hr>

                <div class="row">

                    <div class="col-md-6">

                        <label>Notes</label>

                        <textarea class="form-control" rows="8" placeholder="Thank you for visiting..." name="note"></textarea>

                    </div>

                    <div class="col-md-6">

                        <div class="total-box">

                            <div class="mb-3">

                                <label>Subtotal</label>

                                <input type="number" id="subtotal" class="form-control" name="subtotal" readonly>

                            </div>

                            <div class="mb-3">

                                <label>GST (%)</label>

                                <input type="number" id="gst" value="5" class="form-control" name="gst">

                            </div>

                            <div class="mb-3">

                                <label>Discount</label>

                                <input type="number" id="discount" value="0" class="form-control"
                                    name="discount">

                            </div>

                            <div class="mb-3">

                                <label>Grand Total</label>

                                <input type="number" id="grandTotal" class="form-control fw-bold" name="gTotal"
                                    readonly>

                            </div>

                        </div>

                    </div>

                </div>
            </form>
        </div>

    </div>

    <script>
        function calculateInvoice() {

            let subtotal = 0;

            document.querySelectorAll("#invoiceTable tbody tr").forEach(row => {

                let price = parseFloat(row.querySelector(".price").value) || 0;

                let qty = parseFloat(row.querySelector(".qty").value) || 0;

                let total = price * qty;

                row.querySelector(".total").value = total.toFixed(2);

                subtotal += total;

            });

            document.getElementById("subtotal").value = subtotal.toFixed(2);

            let gst = parseFloat(document.getElementById("gst").value) || 0;

            let discount = parseFloat(document.getElementById("discount").value) || 0;

            let gstAmount = subtotal * gst / 100;

            let grand = subtotal + gstAmount - discount;

            document.getElementById("grandTotal").value = grand.toFixed(2);

        }

        document.addEventListener("input", calculateInvoice);

        document.getElementById("addRow").onclick = function() {

            let row = `
<tr>

                            <td>
                                <input type="text" class="form-control item" name="items[]">
                            </td>

                            <td>
                                <input type="number" class="form-control price" value="0" name='price[]'>
                            </td>

                            <td>
                                <input type="number" class="form-control qty" value="1" name="qty[]">
                            </td>

                            <td>
                                <input type="number" class="form-control total" readonly name="total[]">
                            </td>

                            <td class="text-center no-print">
                                <button class="btn btn-danger removeRow">
                                    ✖
                                </button>
                            </td>

                        </tr>`;

            document.querySelector("#invoiceTable tbody")
                .insertAdjacentHTML("beforeend", row);

            calculateInvoice();

        };

        document.addEventListener("click", function(e) {

            if (e.target.classList.contains("removeRow")) {

                e.target.closest("tr").remove();

                calculateInvoice();

            }

        });

        calculateInvoice();
    </script>

</body>

</html>
