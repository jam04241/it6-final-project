<?php
    include "../database/dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar Layout -->
    <?php include"../Layouts/navbar.php";?>

    <!-- CENTERED ENROLLMENT FORM -->
    <div class="form-wrapper">
        <div class="form-container">
        <h2 class="payment-header">PAYMENT</h2>
        <div class="container-form">
            <div style="width: 45%">
                <label>Enrolled to</label>
                <input type="text" id="enroll_category" name="enroll_category">
                <label>Student ID</label>
                <input type="text" id="student_id" name="student_id">
                <label>First Name</label>
                <input type="text" id="first_name" name="first_name">
                <label>Middle Name</label>
                <input type="text" id="middle_name" name="middle_name">
                <label>Last Name</label>
                <input type="text" id="last_name" name="last_name">
            </div>
            <div style="width: 45%; text-align: center;">
                <div class="card-icon">
                    <img src="CARD_ICON.png" alt="Card Icon">
                </div>
                <div class="payment-fields">
                    <label class="payment-label">Payment Method</label>
                    <select class="form-control">
                        <option value="NULL" selected disabled>SELECT</option>
                        <option value="NULL" id="cash" name="cash">Cash</option>
                        <option value="NULL" id="debit card" name="debit card">Debit Card</option>
                        <option value="NULL" id="gcash" name="gcash">Gcash</option>
                    </select>
                    <label class="payment-label">Amount</label>
                    <input class="payment-input" type="number">
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
<style>
        body {
            background-color: #d3d7df;
            margin: 0;
            padding: 0;
        }
        .navbar-custom {
            background-color: #00324e;
            padding: 12px 20px;
        }
        .navbar-border {
            height: 3px;
            background-color: #0088cc;
        }
        .menu-icon, .profile-icon {
            font-size: 30px;
            color: white;
            cursor: pointer;
            margin: 180px;
        }
        .navbar-toggler {
            border: none;
            padding: 5px;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }
        .offcanvas {
            width: 255px;
            background-color: #012641;
            color: white;
        }
        .offcanvas .Logo {
            text-align: center;
            margin-bottom: 15px;
        }
        .offcanvas .Logo img {
            width: 250px;
            height: 200px;
        }
        .offcanvas ul {
            padding: 0;
            list-style: none;
            margin-top: 20px;
        }
        .offcanvas ul li {
            padding: 12px 20px;
            font-size: 20px;
        }
        .offcanvas ul li a {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .offcanvas ul li:hover {
            background-color: #02486b;
        }
        .divider {
            width: 80%;
            height: 2px;
            background-color: white;
            margin: 20px auto;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center; /* Centers header and form */
        }
        .payment-header {
            font-size: 50px;
            font-family: Tinos;
            font-weight: bold;
            color: black;
            margin-bottom: 10px; /* Keeps it close to the form */
            text-align: center;
        }
        /* Centering the Form Container */
        .form-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center; 
            justify-content: flex-start; 
            min-height: calc(100vh - 100px); 
            padding-top: 90px; 
            gap: 15px; 
        }
        .container-form {
            background-color: #012641;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 157%;
            height: 537px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .container-form label {
            display: block;
            width: 100%;
            margin-top: 16px;
            margin-left: 30px;
            font-weight: bold;
        }
        .container-form input {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: none;
            margin-top: 8px;
            margin-bottom: 10px;
            margin-left: 30px;
        }
        .payment-fields {
            width: 65%;
            max-width: 100%;
            margin-left: 20px;
            text-align: center;
        }
        .payment-label {
            font-weight: bold;
            display: block; /* Places label above input */
            width: 100%; /* Ensures label spans full width */
            text-align: center; /* Centers text inside the label */
        }
        .payment-input {
            background-color: #ffffff;
            padding: 8px;
            border-radius: 5px;
        }
        .card-icon img{
            width: 55%;
            margin-right: 30px;
        }
        .confirm-btn {
            background-color: #32cd32;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 26px;
            margin-right: 50px;
        }
        .footer img {
            width: 100%;
            margin-top: auto; /* Pushes it down naturally */
            position: absolute;
            bottom: 0;
            left: 0;
        }
    </style>
</html>
