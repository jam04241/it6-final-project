<?php
include('../database/dbconnect.php');
//include "helpers/authenticated.php";

if(isset($_GET["student_id"])){
    $student_id = $_GET["student_id"];

    $stmt = $conn->prepare("CALL get_tbl_student_info(1,?)");
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
$address = $row["address"];
$birthdate = $row["birthdate"];
$sex = $row["sex"];
$parent1 = $row["parent1"];
$parent1_contact = $row["parent1_contact"];
$parent2 = $row["parent2"];
$parent2_contact = $row["parent2_contact"];
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
    <title>Enrollment Form</title>

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

    <!-- ENROLLMENT FORM -->
    <div class="container">
        <h2 class="text-align">UPDATE ENROLLMENT FORM</h2>
        <div class="form-container">
            <form method="POST" action="../database/db_update-student.php">
                
                <!-- Hidden field to send student_id -->
                <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

                <div class="row mb-3">
                    <div class="col-4">
                        <label>Enrolled to</label>
                        <select class="form-control" id="enroll_category" name="enroll_category" disabled>
                            <option value="NULL" <?= ($enroll_category == "") ? 'selected' : ''; ?> disabled>Select</option>
                            <option value="Nursery" <?= ($enroll_category == "Nursery") ? 'selected' : ''; ?>>Nursery</option>
                            <option value="Kindergarten_1" <?= ($enroll_category == 'Kindergarten_1') ? 'selected' : ''; ?>>Kindergarten 1</option>
                            <option value="Kindergarten_2" <?= ($enroll_category == 'Kindergarten_2') ? 'selected' : ''; ?>>Kindergarten 2</option>
                            <option value="Tutor" <?= ($enroll_category == "Tutor") ? 'selected' : ''; ?>>Tutor</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label>School Year:</label>
                        <input type="text" class="form-control" id="schoolyear" name="schoolyear" value="<?php echo $schoolyear; ?>" disabled>  
                    </div>

                    <div class="col-2">
                        <label>Status</label>
                        <select type="update" class="form-control" id="" name="is_active" value="is_active" value="<?php echo $is_active; ?>">
                            <option value="1"> Ongoing </option>
                            <option value="0"> Done </option>
                        </select>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>">
                    </div>
                    <div class="col">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
                    </div>
                    <div class="col">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $middle_name; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col"><label>Home Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                    </div>
                    <div class="col"><label>Date of Birth</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $birthdate; ?>">
                    </div>
                    <div class="col">
                        <label>Sex</label>
                        <div class="radio-group">
                        <input type="radio" id="male" name="sex" value="Male" <?= ($sex == "Male") ? 'checked' : ''; ?>>
                        <label for="male">Male</label>

                        <input type="radio" id="female" name="sex" value="Female" <?= ($sex == "Female") ? 'checked' : ''; ?>>
                        <label for="female">Female</label>

                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label>Name of Father</label>
                        <input type="text" class="form-control" id="parent1" name="parent1" value="<?php echo $parent1; ?>">
                    </div>
                    <div class="col">
                        <label>Contact No.</label>
                        <input type="text" class="form-control" id="parent1_contact" name="parent1_contact" value="<?php echo $parent1_contact; ?>">
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label>Name of Mother</label>
                        <input type="text" class="form-control" id="parent2" name="parent2" value="<?php echo $parent2; ?>">
                    </div>
                    <div class="col">
                        <label>Contact No.</label>
                        <input type="text" class="form-control" id="parent2_contact" name="parent2_contact" value="<?php echo $parent2_contact; ?>">
                    </div>
                </div>

                <h5 class="text-align">Person to be notified in case of emergency:</h5>

                <div class="row mb-3">
                    <div class="col">
                        <label>Full Name</label>
                        <input type="text" class="form-control" id="emergency_fullname" name="emergency_fullname" value="<?php echo $emergency_fullname; ?>">
                    </div>
                    <div class="col">
                        <label>Relationship</label>
                        <input type="text" class="form-control" id="emergency_relationship" name="emergency_relationship" value="<?php echo $emergency_relationship; ?>">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col">
                        <label>Address</label>
                        <input type="text" class="form-control" id="emergency_address" name="emergency_address" value="<?php echo $emergency_address; ?>">
                    </div>
                    <div class="col">
                        <label>Contact No.</label>
                        <input type="text" class="form-control" id="emergency_contact_no" name="emergency_contact_no" value="<?php echo $emergency_contact_no; ?>">
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success" onclick="return confirmation()">UPDATE</button>
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
