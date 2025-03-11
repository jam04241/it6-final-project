<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/payment-style.css">
</head>
<body>
    <!-- Navbar Layout -->
    <?php include"../Layouts/navbar.php"?>

    <!-- CENTERED ENROLLMENT FORM -->
    <div class="form-wrapper">
        <div class="form-container">
        <h2 class="payment-header">PAYMENT</h2>
        <div class="container-form">
            <div style="width: 45%">
                <label>Enrolled to</label>
                <input type="text">
                <label>Student ID</label>
                <input type="text">
                <label>First Name</label>
                <input type="text">
                <label>Middle Name</label>
                <input type="text">
                <label>Last Name</label>
                <input type="text">
            </div>
            <div style="width: 45%; text-align: center;">
                <div class="card-icon">
                    <img src="../images/CARD_ICON.png" alt="Card Icon">
                </div>
                <div class="payment-fields">
                    <label class="payment-label">Payment Method</label>
                    <input class="payment-input" type="text">
                    <label class="payment-label">Amount</label>
                    <input class="payment-input" type="text">
                    <br>
                </div>
                    <div style="margin-top: 18px">
                        <button class="confirm-btn">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <img src="FOOTER.png" alt="Footer" class="footer-img">
    </div>
</body>
</html>
