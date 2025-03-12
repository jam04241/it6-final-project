<?php
    include "../helpers/session.php";
    include "../database/dbconnect.php";
    if(isset($_GET["student_id"])){
        $student_id = $_GET["student_id"];
    
        $stmt = $conn->prepare("	SELECT 
                                            enroll_category, 
                                            last_name,
                                            first_name, 
                                            middle_name                                     
                                        FROM 
                                            tbl_student_info
                                        WHERE
                                            isactive = 1
                                        AND
                                            student_id= ?;");
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            die("Student not found!");
        }
        $stmt->close();
    } else {
        die("Invalid request!");
    }

    $enroll_category = $row["enroll_category"];
    $last_name = $row["last_name"];
    $first_name = $row["first_name"];
    $middle_name = $row["middle_name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../style/payment-style.css">

</head>
<body>
    <!-- Navbar Layout -->
    <?php include"../Layouts/paymentnavbar.php"?>

    <!-- CENTERED ENROLLMENT FORM -->
    <div class="form-wrapper">
        <div class="form-container">
        <h2 class="payment-header">PAYMENT</h2>
        <div class="container-form">
            <div style="width: 45%">
                <label>Enrolled to <i>(NON EDITABLE)</i></label>
                <input type="text" id="enroll_category" name="enroll_category" value="<?= htmlspecialchars($enroll_category); ?>" readonly>
                <label>Student ID <i>(NON EDITABLE)</i></label>
                <input type="text" id="student_id" name="student_id" value="<?= htmlspecialchars($student_id); ?>" readonly>
                <label>First Name <i>(NON EDITABLE)</i></label>
                <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($first_name); ?>" readonly>
                <label>Middle Name <i>(NON EDITABLE)</i></label>
                <input type="text" id="middle_name" name="middle_name" value="<?= htmlspecialchars($middle_name); ?>" readonly>
                <label>Last Name <i>(NON EDITABLE)</i></label>
                <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($last_name); ?>" readonly>
            </div>
            <form action="../database/db_payment_student.php" method="POST">
            <div style="width: 45%; text-align: center;">
                <div class="card-icon">
                    <img src="../images/SCHOOL_LOGO.png" alt="Card Icon">
                </div>
                <div class="payment-section">
                    
                        <label class="payment-label" for="payment-method">Payment Method</label>
                        <select class="payment-input" id="payment-method" name="payment-method">
                            <option value="" disabled selected>Select Payment Method</option>
                            <option value="Cash">Cash</option>
                            <option value="Gcash">Gcash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                        <label class="payment-label" for="amount">Amount</label>
                        <input class="payment-input" type="text" id="amount" name="amount">
                </div>
                        <div style="margin-top: 18px">
                            <button class="confirm-btn">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <img src="../images/FOOTER.png" alt="Footer" class="footer-img">
    </div>
</body>
</html>
