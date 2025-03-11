<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="../DataTables/datatables.css">
    <style>

    </style>
</head>
<body>
        <!-- Navbar Layout -->
        <?php include"../Layouts/navbar.php"?>

    <div>
        <h1>Tutorial Registration Form</h1>
        <div class="container-box">
            <form>
                <h3>REGISTRATION FORM</h3>
                <div class="col-md-2">
                    <label for="start-date" class="form-label">Date Started</label>
                    <input type="date" id="start-date" name="start-date" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <label for="school-name" class="form-label">School</label>
                        <input type="text" id="school-name" name="school-name" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="middle_name" class="form-label">Time Arrival</label>
                        <input type="time" id="middle_name" name="middle_name" class="form-control">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" class="form-control">
                    </div>
                </div>
    
                <div class="row mt-1">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="grade" class="form-label">Grade</label>
                        <input type="text" id="grade" name="grade" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sex</label>
                        <div>
                            <input type="radio" id="male" name="sex" value="male">
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="sex" value="female">
                            <label for="female">Female</label>
                        </div>
                    </div>
                </div>
    
                <div class="row mt-4">
                    <h3>PERSON TO BE NOTIFIED IN CASE OF EMERGENCY</h3>

                    <div class="col-md-7">
                        <label for="parent-name" class="form-label">Parent Name</label>
                        <input type="text" id="parent-name" name="parent-name" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <label for="relationship" class="form-label">Relationship</label>
                        <input type="text" id="relationship" name="relationship" class="form-control">
                    </div>
                    <div class="col-md-7">
                        <label for="parent-address" class="form-label">Address</label>
                        <input type="text" id="parent-address" name="parent-address" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <label for="parent_contact" class="form-label">Contact No.</label>
                        <input type="text" id="parent_contact" name="parent_contact" class="form-control">
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-custom">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
    
</body>
</html>
