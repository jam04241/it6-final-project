<?php 

include '../script/confirmation.php'; 
include "../database/dbconnect.php";

if(isset($_GET["student_id"])){
    $student_id = $_GET["student_id"];

    $stmt = $conn->prepare("	SELECT
                                        enroll_category,
                                        schoolyear,
                                        last_name,
                                        first_name, 
                                        middle_name,
                                        emergency_fullname,
                                        emergency_relationship,
                                        emergency_address,
                                        emergency_contact_no
                                    FROM 
                                        tbl_student_info
                                    WHERE
                                        isactive = 1
                                    AND
                                        student_id = ?;");

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

// Retrieve form data from POST
$enroll_category = $row["enroll_category"];
$schoolyear = $row["schoolyear"];
$last_name = $row["last_name"];
$first_name = $row["first_name"];
$middle_name = $row["middle_name"];
$emergency_fullname = $row["emergency_fullname"];
$emergency_relationship = $row["emergency_relationship"];
$emergency_address = $row["emergency_address"];
$emergency_contact_no = $row["emergency_contact_no"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Enrollment Form</title>

    <link rel="stylesheet" href="../style/add-enrollment-form-style.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
</head>
<body>
    <!-- Navbar Layout -->
    <?php include"../Layouts/navbar.php"?>
    
    <!-- REGISTRATION FORM -->
    <div class="container">
        <h2 class="text-align">UPDATE ENROLLMENT FORM</h2>
        <div class="form-container">
            <form method="POST" action="../database/db_add_enrollment.php">
                <div class="row mb-3">
                    <div class="col-4">
                    <!-- Hidden field to send student_id -->
                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

                    <label>Enrolled to</label>
                        <select class="form-control" id="enroll_category" name="enroll_category">
                            <option value="NULL" <?= ($enroll_category == "") ? 'selected' : ''; ?>>Select</option>
                            <option value="Nursery" <?= ($enroll_category == "Nursery") ? 'selected' : ''; ?>>Nursery</option>
                            <option value="Kindergarten_1" <?= ($enroll_category == 'Kindergarten_1') ? 'selected' : ''; ?> >Kindergarten 1</option>
                            <option value="Kindergarten_2" <?= ($enroll_category == 'Kindergarten_2') ? 'selected' : ''; ?> >Kindergarten 2</option>
                            <option value="Tutor" <?= ($enroll_category == "Tutor") ? 'selected' : ''; ?> >Tutor</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label>School Year:</label>
                        <input type="text" class="form-control" id="schoolyear" name="schoolyear" value="<?php echo $schoolyear; ?>">  
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label>Last Name <i>(NON EDITABLE)</i></label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" readonly>
                    </div>
                    <div class="col">
                        <label>First Name <i>(NON EDITABLE)</i></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" readonly>
                    </div>
                    <div class="col">
                        <label>Middle Name <i>(NON EDITABLE)</i></label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $middle_name; ?>" readonly>
                    </div>
                </div>

                <h5 class="text-align">Person to be notified in case of emergency:</h5>

                <div class="row mb-3">
                    <div class="col">
                        <label>Full Name <i>(NON EDITABLE)</i></label>
                        <input type="text" class="form-control" id="emergency_fullname" name="emergency_fullname" value="<?php echo $emergency_fullname; ?>" readonly>
                    </div>
                    <div class="col">
                        <label>Relationship <i>(NON EDITABLE)</i></label>
                        <input type="text" class="form-control" id="emergency_relationship" name="emergency_relationship" value="<?php echo $emergency_relationship; ?>" readonly>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col">
                        <label>Address <i>(NON EDITABLE)</i></label>
                        <input type="text" class="form-control" id="emergency_address" name="emergency_address" value="<?php echo $emergency_address; ?>" readonly>
                    </div>
                    <div class="col">
                        <label>Contact No. <i>(NON EDITABLE)</i></label>
                        <input type="text" class="form-control" id="emergency_contact_no" name="emergency_contact_no" value="<?php echo $emergency_contact_no; ?>" readonly>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success" onclick="return confirmation()">ADD</button>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <img src="FOOTER.png" alt="Footer" class="footer-img">
    </div>


</body>
    <script>
            function confirmation() {
            var result = confirm('Are you sure about this?');
            if (result) {
                window.location.href = '../website/student-information.php';
            } else {
                return false;
            }
        }
    </script>
</html>
