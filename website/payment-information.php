<?php 
include "../database/dbconnect.php";

try {
    if (!$conn) {
        die("Database connection failed: " . $conn->error);
    }

    $sql = "SELECT student_id, pay, total, balance, date_created, date_updated FROM tbl_payment;";
    $result = $conn->query($sql);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/DataTables/datatables.min.css">
    <script src="/DataTables/datatables.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="../DataTables/datatables.css">
    <script src="../DataTables/datatables.js" defer></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery (Required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="../script/payment-form-script.js"></script>
    <!-- STYLE FOR NAVBAR AND SIDEBAR -->
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
        .container {
            max-width: 1300px;
            margin: auto;
            padding: 30px;
        }
        .form-container {
            background-color: #012641;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .form-control {
            background-color: white;
            border: none;
            padding: 10px;
        }
        .update-btn {
            background-color: #32cd32;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .footer {
            text-align: center;
            padding: 10px;
            color: white;
            position: relative;
            width: 100%;
        }
        .footer-img {
            max-width: 100%;
            height: auto;
        }
        .text-align{
            font-family: Tinos;
            font-size: 30px;
        }
        .form-container{
            font-family: montserrat;
        }
        .radio-group {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-top: 10px; 
        }
        .radio-group label {
        margin-right: 60px; 
        }
        .dropdown-menu {
        background-color: #023047; /* Blue background */
        border: none; /* Remove border */
        }

        .dropdown-item {
            color: white; /* White text */
        }

        .dropdown-item:hover {
            background-color: #02486b; /* Darker blue on hover */
            color: #fff; /* Ensure text stays white */
        }
        #student-information th, #student-missing-information th {
        text-align: center;
        }
        #student-information td, #student-missing-information td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <!-- Navbar Layout -->
    <?php include"../Layouts/navbar.php"?>


<!-- PAYMENT FORM -->
<div class="container mt-4">
    <h1 class="text-center">PAYMENT STATUS</h1>
    <table id="student-payment-status" class="table table-striped mt-3">
        <thead>
            <tr>
                <th>STUDENT ID</th>
                <th>PAY</th>
                <th>TOTAL</th>
                <th>BALANCE</th>
                <th>CREATED DATE</th>
                <th>UPDATED DATE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
        <?php if(isset($result) && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                            <td> <?=$row['student_id']?> </td>
                            <td> <?=$row['pay']?> </td>
                            <td> <?=$row['total']?> </td>
                            <td> <?=$row['balance']?> </td>
                            <td> <?=$row['date_created']?> </td>
                            <td> <?=$row['date_updated']?> </td>
                            <td>
                                <a class="btn btn-warning btn-sm edit-btn" href="payment-form.php?student_id=<?= htmlspecialchars($row['student_id']); ?>">
                                    Edit
                                </a>
                                
                                <a class="btn btn-secondary btn-sm form1-btn">
                                    Form 1
                                </a>

                                <form action="../database/db_delete_student.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');" class="d-inline">
                                    <input type="hidden" name="student_id" value="<?= htmlspecialchars($row['student_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                                </form>           
                                                   
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No students available</td>
                        </tr>
                    <?php endif; ?>
            <!-- Dynamic Data Goes Here -->
        </tbody>
    </table>
</div>

<!-- DONE PAYMENT -->
<div class="container mt-4">
    <h1 class="text-center">Done Payment</h1>
    <table id="student-done-payment" class="table table-striped mt-3">
        <thead>
            <tr>
            <th>STUDENT ID</th>
                <th>PAY</th>
                <th>TOTAL</th>
                <th>BALANCE</th>
                <th>TIMESTAMP</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dynamic Data Goes Here -->
        </tbody>
    </table>
</div>



    <div class="footer">
        <img src="FOOTER.png" alt="Footer" class="footer-img">
    </div>

</body>
</html>
