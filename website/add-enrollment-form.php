<?php 

include '../script/confirmation.php'; 

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
    
    <!-- ENROLLMENT FORM -->
    <div class="container">
        <h2 class="text-align">ENROLLMENT FORM</h2>
        <div class="form-container">
            <form method="POST" action="../database/db_add_student.php">
                <div class="row mb-3">
                    <div class="col-4">
                        <label>Enrolled to</label>
                        <select class="form-control" id="enroll_category" name="enroll_category" required>
                            <option value="" selected disabled>Grade Level</option>
                            <option value="Nursery">Nursery</option>
                            <option value="Kindergarten_1">Kindergarten 1</option>
                            <option value="Kindergarten_2">Kindergarten 2</option>
                            <option value="Tutor">Tutor</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label>School Year:</label>
                        <input type="year" class="form-control" id="schoolyear" name="schoolyear" required>  
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="col">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col"><label>Home Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="col"><label>Date of Birth</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="col">
                        <label>Sex</label>
                        <div class="radio-group">
                            <input type="radio" value="male" id="male" name="sex">
                            <label for="male">Male</label>                       
                            <input type="radio" value="female" id="female" name="sex">
                            <label for="female">Female</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col"><label>Name of Father</label>
                    <input type="text" class="form-control" id="parent1" name="parent1"></div>
                    <div class="col"><label>Contact No.</label>
                    <input type="text" class="form-control" id="parent1_contact" name="parent1_contact"></div>
                </div>

                <div class="row mb-3">
                    <div class="col"><label>Name of Mother</label>
                    <input type="text" class="form-control" id="parent2" name="parent2"></div>
                    <div class="col"><label>Contact No.</label>
                    <input type="text" class="form-control" id="parent2_contact" name="parent2_contact"></div>
                </div>

                <h5 class="text-align">Person to be notified in case of emergency:</h5>

                <div class="row mb-3">
                    <div class="col">
                        <label>Full Name</label>
                        <input type="text" class="form-control" id="emergency_fullname" name="emergency_fullname" required>
                    </div>
                    <div class="col">
                        <label>Relationship</label>
                        <input type="text" class="form-control" id="emergency_relationship" name="emergency_relationship" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col">
                        <label>Address</label>
                        <input type="text" class="form-control" id="emergency_address" name="emergency_address" required>
                    </div>
                    <div class="col">
                        <label>Contact No.</label>
                        <input type="text" class="form-control" id="emergency_contact_no" name="emergency_contact_no" required>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success" onclick="return confirmation()">Submit</button>
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
