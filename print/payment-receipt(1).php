<?php
include "../helpers/session.php";
include "../database/dbconnect.php";

// Validate request
if (!isset($_GET["student_id"])) {
    die("Invalid request! Student ID is missing.");
}

$student_id = $_GET["student_id"];

// Fetch payment details
$stmt = $conn->prepare("SELECT * FROM tbl_payment WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Payment record not found for Student ID: $student_id");
}

$payment = $result->fetch_assoc(); // Store payment details properly

// Fetch student details using the correct student_id
$student_stmt = $conn->prepare("SELECT * FROM tbl_student_info WHERE student_id = ?");
$student_stmt->bind_param("i", $student_id);
$student_stmt->execute();
$student_result = $student_stmt->get_result();

if ($student_result->num_rows === 0) {
    die("Student record not found for Student ID: " . $student_id);
}

$student = $student_result->fetch_assoc();
?>


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
            <div class="p-3 text-center">
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
                        <label class="me-2"><strong>Student ID:</strong></label>
                        <input type="text" class="input-line" value="<?= htmlspecialchars($student["student_id"]) ?>" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label class="me-2"><strong>Name:</strong></label>
                        <input type="text" class="input-line" value="<?= htmlspecialchars($student["first_name"] . " " . $student["last_name"]) ?>" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label class="me-2"><strong>Contact #:</strong></label>
                        <input type="text" class="input-line" value="<?= htmlspecialchars($student["emergency_contact_no"] ?? 'N/A') ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2 d-flex align-items-center">
                        <label class="me-2"><strong>Receipt No:</strong></label>
                        <input type="text" class="input-line" value="<?= htmlspecialchars($payment["payment_no"]) ?>" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label class="me-2"><strong>Date:</strong></label>
                        <input type="text" class="input-line" value="<?= htmlspecialchars($payment["date_updated"]) ?>" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label class="me-2"><strong>Payment Method:</strong></label>
                        <input type="text" class="input-line" value="<?= htmlspecialchars($payment["payment_method"]) ?>" readonly>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <label class="me-2"><strong>Transaction #:</strong></label>
                        <input type="text" class="input-line" value="<?= htmlspecialchars('TXN-' . strtoupper(substr(md5(uniqid()), 0, 4)) . date("YmdHis")) ?>" readonly>
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
                        <td><?= htmlspecialchars($payment["date_created"]) ?></td>
                        <td>Tuition Fee</td>
                        <td>Education</td>
                        <td>₱<?= number_format($payment["pay"], 2) ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="text-end">
                <label class="me-5"><strong>Total Amount :</strong></label>
                <input type="text" class="input-line-total" value="₱<?= number_format($payment["total"], 2) ?>" readonly>
            </div>
        </div>
    </div>
</body>

<style>
    body {
        background-color: #ECF1FF;
    }
    .input-line{
        width: 10px;
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
        width: 50%;
        text-align: center;
        background: transparent;
    }
    .input-line-total {
        border: none;
        border-bottom: 1px solid black;
        outline: none;
        height: 25px;
        width: 25%;
        text-align:center;
        background: transparent;
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
