<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
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
        .footer img {
            position: relative;
            width: 100%;
            bottom: 0;
            padding-top: 20px;
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
</style>
<body>


        <!-- FORM 1 CONTAINER NI -->
        <div class="print-section">
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <h3 class="text-center"><strong>FORM 1</strong></h3>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col d-flex justify-content-end gap-3">
                    <button class="btn btn-dark no-print" onclick="window.print()">🖨️ PRINT</button>
                    <a class="btn btn-dark no-print" href="../website/payment-form.php">↩️ BACK</a>
                </div>  
            </div>
        </div>
    </div>
        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="p-4 bg-light border shadow-sm" style="max-width: 900px; width: 100%;">
                <div class="row align-items-start">
                    <div class="col-md-6">
                        <h5 class="fw-bold">Student Information</h5>
                        <p class="fw-bold mb-0">Student ID</p>
                        <p>544053</p>
                        <div class="row">
                            <div class="col-md-4">
                                <p class="fw-bold mb-0">Last Name</p>
                                <p>Magcalas</p>
                            </div>
                            <div class="col-md-4">
                                <p class="fw-bold mb-0">First Name</p>
                                <p>Josh Andrei</p>
                            </div>
                            <div class="col-md-4">
                                <p class="fw-bold mb-0">Middle Initial</p>
                                <p>Mosqueda</p>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">Grade Level</p>
                        <p>Smurf</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <img src="../images/SCHOOL_LOGO.png" alt="School Logo" class="mb-2" style="max-width: 120px;">
                        <h6 class="fw-bold mb-0">Buligen-Puentespina Learning Center</h6>
                        <p class="fw-bold mb-0">SPED, Bangkal, Davao City</p>
                        <p class="fw-bold mb-0">Philippines, 8000</p>
                        <p><strong>0916 4622 065 / 0933 8279 305</strong></p>
                    </div>
                </div>
                <p class="small text-muted">Please be reminded that late payment shall be subject to promissory as agreed by both parties prior to the enrollment. Therefore, kindly pay the amount payable within the allotted time.</p>
                <h5 class="text-center fw-bold">SCHOOL SCHEDULE</h5>
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Subjects</th>
                            <th>Time</th>
                            <th>Room</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Mathematics</td><td>08:00AM - 09:00AM</td><td>H3N</td></tr>
                        <tr><td>Science</td><td>09:00AM - 10:00AM</td><td>H3N</td></tr>
                        <tr><td>English</td><td>10:00AM - 11:00AM</td><td>H3N</td></tr>
                        <tr><td>Filipino</td><td>12:00PM - 01:00PM</td><td>H3N</td></tr>
                        <tr><td>Values</td><td>01:00PM - 02:00PM</td><td>H3N</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
