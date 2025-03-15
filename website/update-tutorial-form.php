    <?php 

    include '../script/confirmation.php'; 
    include '../database/dbconnect.php';

    if(isset($_GET["tutorial_id"])){
        $tutorial_id = $_GET["tutorial_id"];
    
        $stmt = $conn->prepare("	SELECT 
                                            date_start, 
                                            school,
                                            grade_level,
                                            time_arrival,
                                            focus_subject, 
                                            last_name,
                                            first_name,
                                            middle_name,
                                            sex,
                                            street,
                                            city,
                                            zip_code, 
                                            birthdate, 
                                            emergency_fullname,
                                            emergency_relationship,
                                            emergency_address,
                                            emergency_contact_no,
                                            isactive                                        
                                        FROM 
                                            tbl_tutor_info
                                        WHERE
                                            tutorial_id= ?;");
        $stmt->bind_param("i", $tutorial_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            die("Tutor not found!");
        }
        $stmt->close();
    } else {
        die("Invalid request!");
    }
    
    // Retrieve form data from POST
    $date_start = $row["date_start"];
    $school = $row["school"];
    $grade_level = $row["grade_level"];
    $time_arrival = $row["time_arrival"];
    $focus_subject = $row["focus_subject"];
    $last_name = $row["last_name"];
    $first_name = $row["first_name"];
    $middle_name = $row["middle_name"];
    $birthdate = $row["birthdate"];
    $sex = $row["sex"];
    $street = $row["street"];
    $city = $row["city"];
    $zip_code = $row["zip_code"];
    $emergency_fullname = $row["emergency_fullname"];
    $emergency_relationship = $row["emergency_relationship"];
    $emergency_address = $row["emergency_address"];
    $emergency_contact_no = $row["emergency_contact_no"];
    $isactive = $row["isactive"];

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
        <?php include"../Layouts/navbar.php" ?>
        
        <!-- ENROLLMENT FORM -->
        <div class="container">
            <h2 class="text-align">UPDATE TUTOR FORM</h2>
            <div class="form-container">
                <form method="POST" action="../database/db_update-tutor.php">
                    
                <!-- Hidden field to send tutorial_id -->
                <input type="hidden" name="tutorial_id" value="<?= htmlspecialchars($tutorial_id); ?>">
                    <div class="row mb-3">
                        <div class="col-3"><label>Starting Date</label>
                            <input type="date" class="form-control" id="date_start" name="date_start" value="<?= htmlspecialchars($date_start); ?>" required>
                        </div>
                        <div class="col-3"><label>Status</label>
                            <select class="form-control" id="isactive" name="isactive">
                                <option value="" disabled>Select</option>
                                <option value= "1" <?= ($isactive == "1") ? 'selected' : ''; ?> >Ongoing</option>
                                <option value= "0" <?= ($isactive == "0") ? 'selected' : ''; ?> >Done</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-3">
                            <label>School</label>
                            <input type="text" class="form-control" id="school" name="school" value="<?= htmlspecialchars($school); ?>" required>
                        </div>
                        <div class="col-2">
                            <label>Grade level</label>
                            <select class="form-control" id="grade_level" name="grade_level" value="<?= htmlspecialchars($grade_level); ?>" required>
                                <option value="" selected disabled>Select Grade Level</option>
                                <optgroup label="Pre-School"> 
                                    <option value="Nursery" <?= ($grade_level == "Nursery") ? 'selected' : ''; ?>>Nursery</option>
                                    <option value="Kindergarten 1" <?= ($grade_level == "Kindergarten 1") ? 'selected' : ''; ?>>Kindergarten 1</option>
                                    <option value="Kindergarten 2" <?= ($grade_level == "Kindergarten 2") ? 'selected' : ''; ?>>Kindergarten 2</option>
                                </optgroup>
                                <optgroup label="Elementary Level">
                                    <option value="Grade 1" <?= ($grade_level == "Grade 1") ? 'selected' : ''; ?>>Grade 1</option>
                                    <option value="Grade 2" <?= ($grade_level == "Grade 2") ? 'selected' : ''; ?>>Grade 2</option>
                                    <option value="Grade 3" <?= ($grade_level == "Grade 3") ? 'selected' : ''; ?>>Grade 3</option>
                                    <option value="Grade 4" <?= ($grade_level == "Grade 4") ? 'selected' : ''; ?>>Grade 4</option>
                                    <option value="Grade 5" <?= ($grade_level == "Grade 5") ? 'selected' : ''; ?>>Grade 5</option>
                                    <option value="Grade 6" <?= ($grade_level == "Grade 6") ? 'selected' : ''; ?>>Grade 6</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-3">
                            <label>Focus Subject</label>
                            <input type="text" class="form-control" id="focus_subject" name="focus_subject" value="<?= htmlspecialchars($focus_subject); ?>" required>
                        </div>
                        <div class="col-3">
                            <label>Time Arrival</label>
                            <input type="time" class="form-control" id="time_arrival" name="time_arrival" value="<?= htmlspecialchars($time_arrival); ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-3">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($last_name); ?>" required>
                        </div>
                        <div class="col-5">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($first_name); ?>" required>
                        </div>
                        <div class="col-4">
                            <label>Middle Initial</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?= htmlspecialchars($middle_name); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col"><label>Street</label>
                            <input type="text" class="form-control" id="street" name="street" value="<?= htmlspecialchars($street); ?>" required>
                        </div>
                        <div class="col"><label>City</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($city); ?>" required>
                        </div>
                        <div class="col"><label>Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?= htmlspecialchars($zip_code); ?>" required>
                        </div>
                        <div class="col"><label>Date of Birth</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= htmlspecialchars($birthdate); ?>" required>
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

                    <h5 class="text-align">Person to be notified in case of emergency:</h5>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Full Name</label>
                            <input type="text" class="form-control" id="emergency_fullname" name="emergency_fullname" value="<?= htmlspecialchars($emergency_fullname); ?>"  required>
                        </div>
                        <div class="col">
                        <label>Relationship</label>
                            <select class="form-control" id="emergency_relationship" name="emergency_relationship">
                                <option value="" <?= ($emergency_relationship == "") ? 'selected' : ''; ?> disabled>Select</option>
                                <option value="mother" <?= ($emergency_relationship == 'mother') ? 'selected' : ''; ?>>Mother</option>
                                <option value="father" <?= ($emergency_relationship == 'father') ? 'selected' : ''; ?>>Father</option>
                                <option value="guardian" <?= ($emergency_relationship == 'guardian') ? 'selected' : ''; ?>>Guardian</option>
                                <option value="others" <?= ($emergency_relationship == "others") ? 'selected' : ''; ?>>Others</option>
                            </select>
                        </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label>Address</label>
                            <input type="text" class="form-control" id="emergency_address" name="emergency_address" value="<?= htmlspecialchars($emergency_address); ?>"  required>
                        </div>
                        <div class="col">
                            <label>Contact No.</label>
                            <input type="text" class="form-control" id="emergency_contact_no" name="emergency_contact_no" value="<?= htmlspecialchars($emergency_contact_no); ?>"  required>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success" onclick="return confirmation()">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="footer">
            <img src="../images/FOOTER.png" alt="Footer" class="footer-img">
        </div>

    </body>
        <script>
                function confirmation() {
                var result = confirm('Are you sure about this?');
                if (result) {
                    window.location.href = '../website/tutorial-listing.php';
                } else {
                    return false;
                }
            }
        </script>
    </html>
