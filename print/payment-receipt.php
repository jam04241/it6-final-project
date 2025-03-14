<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="print-section">
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <h1 class="text-center"><strong>PAYMENT RECEIPT</strong></h1>
                </div>      
            </div>
            <div class="row mb-3">
                <div class="col d-flex justify-content-end gap-3">
                    <button class="btn btn-dark no-print" onclick="window.print()">🖨️ PRINT</button>
                    <a class="btn btn-dark no-print" href="../website/payment-information.php">↩️ BACK</a>
                </div>  
            </div>
        </div>
    </div>
    <div class="container">
        <div class="receipt-card mt-3 p-4">
            <div class=" p-3 text-center">
                <img src="../images/SCHOOL_LOGO.png" alt="School Logo" width="200">
                <h5><strong>BULIGEN-PUENTESPINA LEARNING CENTER</strong></h5>
                <h5><strong> SPED BANGKAL, DAVAO CITY </strong></h5>
            </div>
            <div class="text-center">
                <h5><strong>RECEIPT DETAILS</strong></h5>
            </div>

            <div class="mt-3">
                <span class="official-receipt">OFFICIAL RECEIPT</span>
            </div>

            <div class="mt-3">
                <span class="student-info">STUDENT INFORMATION</span>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="mb-2 d-flex align-items-center">
                        <label for="student-id" class="me-2"><strong>Student ID:</strong></label>
                        <input type="text" id="student-id" class="input-line" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label for="name" class="me-2"><strong>Name:</strong></label>
                        <input type="text" id="name" class="input-line" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label for="contact" class="me-2"><strong>Contact #:</strong></label>
                        <input type="text" id="contact" class="input-line" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2 d-flex align-items-center">
                        <label for="receipt-no" class="me-2"><strong>Receipt No:</strong></label>
                        <input type="text" id="receipt-no" class="input-line" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label for="date" class="me-2"><strong>Date:</strong></label>
                        <input type="text" id="date" class="input-line" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label for="payment" class="me-2"><strong>Payment Method:</strong></label>
                        <input type="text" id="payment" class="input-line" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label for="transaction" class="me-2"><strong>Transaction #:</strong></label>
                        <input type="text" id="transaction" class="input-line" readonly>
                    </div>
                </div>
            </div>

            <table class="table table-bordered mt-3">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Fee</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2025-03-09</td>
                        <td>Tuition Fee</td>
                        <td>Education</td>
                        <td>₱10,000.00</td>
                    </tr>
                    <tr>
                        <td>2025-03-09</td>
                        <td>Library Fee</td>
                        <td>Miscellaneous</td>
                        <td>₱1,100.00</td>
                    </tr>
                </tbody>
            </table>

            <div class="text-end">
                <label for="total-amount" class="me-2"><strong>Total Amount :</strong></label>
                <input type="text" id="total-amount" class="input-line">
            </div>
        </div>
    </div>
</body>
<style>
    body {
        background-color: #ECF1FF;
    }
    .receipt-card {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .official-receipt {
        background: red;
        color: white;
        font-weight: bold;
        padding: 5px 10px;
        display: inline-block;
        border-radius: 5px;
    }
    .student-info {
        background: #143D60;
        color: white;
        padding: 5px 10px;
        display: inline-block;
        border-radius: 5px;
    }
    .input-line {
        border: none;
        border-bottom: 1px solid black;
        outline: none;
        height: 25px;
    }
    .footer img {
            position: relative;
            width: 100%;
            bottom: 0;
            padding-top: 50px;
        }
    .print-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 800px;
        margin: auto;
        margin-top: 30px;
        padding: 0 10px;
    }
    @media print {
    .no-print {
        display: none !important;
    }
}
</style>
</html>
