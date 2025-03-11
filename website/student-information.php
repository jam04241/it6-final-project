<?php 
include "../database/dbconnect.php";

try {
    if (!$conn) {
        die("Database connection failed: " . $conn->error);
    }

    $sql = "	SELECT
                    student_id,
                    first_name,
                    middle_name,
                    last_name,
                    enroll_category,
                    date_created,
                    date_updated
                FROM
                    tbl_student_info
                WHERE
                    isactive = 1;";
                    
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

    <script src="../script/student-form-script.js"></script>
    
    <!-- STYLE FOR NAVBAR AND SIDEBAR -->
</head>
<body>

    <!-- Navbar Layout -->
    <?php include"../Layouts/navbar.php"?>

    <!-- ENROLLMENT FORM -->
    <div class="container mt-4">
        <h1 class="text-center">Student Information</h1>
            <table id="student-information" class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Middle Inital</th>
                        <th>Last Name</th>
                        <th>Grade Level</th>
                        <th>Date Created</th>
                        <th>Date Updated</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($result) && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td> <?=$row['student_id']?> </td>
                            <td> <?=$row['first_name']?> </td>
                            <td> <?=$row['middle_name']?> </td>
                            <td> <?=$row['last_name']?> </td>
                            <td> <?=$row['enroll_category']?> </td>
                            <td> <?=$row['date_created']?> </td>
                            <td> <?=$row['date_updated']?> </td>
                            <td>
                                <a class="btn btn-secondary btn-sm edit-btn" href="add-enrollment-form.php?student_id=<?= htmlspecialchars($row['student_id']); ?>">
                                    Enroll
                                </a>

                                <a class="btn btn-warning btn-sm edit-btn" href="update-enrollment-form.php?student_id=<?= htmlspecialchars($row['student_id']); ?>">
                                    Edit
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
                </tbody>
            </table>
    </div>

        <!-- MISSING FORM -->
        <!-- <div class="container mt-4">
        <h1 class="text-center">Missing Information</h1>
            <table id="student-missing-information" class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Middle Inital</th>
                        <th>Last Name</th>
                        <th>Grade Level</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                <?php if(isset($result) && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td> <?= htmlspecialchars($row['student_id'], ENT_QUOTES, 'UTF-8'); ?> </td>
                            <td> <?= htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8'); ?> </td>
                            <td> <?= htmlspecialchars($row['middle_inital'], ENT_QUOTES, 'UTF-8'); ?> </td>
                            <td> <?= htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8'); ?> </td>
                            <td> <?= htmlspecialchars($row['enroll_category'], ENT_QUOTES, 'UTF-8'); ?> </td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-btn" 
                                        onclick="window.location.href='update-enrollment-form.php?student_id=<?= htmlspecialchars($row['student_id'], ENT_QUOTES, 'UTF-8'); ?>'">
                                        Edit
                                </button>
                                <a>
                                <form action="../database/db_delete_student.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    <input type="hidden" name="student_id" value="<?= htmlspecialchars($row['student_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                </a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
                </tbody>
            </table> -->
    </div>

    <div class="footer">
        <img src="FOOTER.png" alt="Footer" class="footer-img">
    </div>
</body>
    <style>
        #student-information th, #student-missing-information th {
        text-align: center;
        }
        #student-information td, #student-missing-information td {
            text-align: center;
            vertical-align: middle;
        }
    </style>

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
