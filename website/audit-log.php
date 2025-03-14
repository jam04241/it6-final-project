<?php 
include "../database/dbconnect.php";
include"../Layouts/navbar.php";
try {
    if (!$conn) {
        die("Database connection failed: " . $conn->error);
    }

    $sql = "SELECT * FROM tbl_audit_log ORDER BY timestamp DESC;";
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
    <?php //include"../Layouts/navbar.php"?> <!--due to coflict of connection i put it above--> 


    <!-- Audit History -->
    <div class="container mt-4">
        <h1 class="text-center">TRACKING HISTORY</h1>
            <table id="tracking-list" class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Audit log number</th>
                        <th>EMPLOYEE_ID</th>
                        <th>POSITION</th>
                        <th>DESCRIPTION</th>
                        <th>DATE</th>

                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($result)): ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                        <td><?= htmlspecialchars($row['audit_no']) ?></td>
                        <td><?= htmlspecialchars($row['employee_id']) ?></td>
                        <td><?= htmlspecialchars($row['position']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['timestamp']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No tracking history</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
    </div>

    <div class="footer">
        <img src="../images/FOOTER.png" alt="Footer" class="footer-img">
    </div>

</body>

    <script src="../script/transaction-form-script.js"></script>

</html>
