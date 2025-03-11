<?php 
include "../database/dbconnect.php";

try {
    if (!$conn) {
        die("Database connection failed: " . $conn->error);
    }

    // Array to store query results
    $nursery_students = [];
    $kindergarten1_students = [];
    $kindergarten2_students = [];

    // Run each stored procedure separately with proper handling
    $queries = [
        "CALL query_nursery_list()",
        "CALL query_kindergarten_1_list()",
        "CALL query_kindergarten_2_list()"
    ];

    foreach ($queries as $index => $query) {
        if ($conn->multi_query($query)) {
            do {
                if ($result = $conn->store_result()) {
                    while ($row = $result->fetch_assoc()) {
                        if ($index == 0) {
                            $nursery_students[] = $row;
                        } elseif ($index == 1) {
                            $kindergarten1_students[] = $row;
                        } elseif ($index == 2) {
                            $kindergarten2_students[] = $row;
                        }
                    }
                    $result->free(); // Free result set
                }
            } while ($conn->next_result()); // Move to the next result set
        } else {
            throw new Exception("Query Failed: " . $conn->error);
        }
    }

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

    <script src="../script/listing-script.js"></script>
    
    <!-- STYLE FOR NAVBAR AND SIDEBAR -->
</head>
<body>

    <!-- Navbar Layout -->
    <?php include"../Layouts/navbar.php"?>

    <!-- NURSERY FORM -->
    <div class="container mt-4">
        <h1 class="text-center">NURSERY STUDENT</h1>
            <table id="nursery-list" class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Middle Inital</th>
                        <th>Last Name</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($nursery_students)): ?>
                    <?php foreach ($nursery_students as $row): ?>
                        <tr>
                        <td><?= htmlspecialchars($row['student_id']) ?></td>
                        <td><?= htmlspecialchars($row['first_name']) ?></td>
                        <td><?= htmlspecialchars($row['middle_name']) ?></td>
                        <td><?= htmlspecialchars($row['last_name']) ?></td>
                            <td>

                                <a class="btn btn-warning btn-sm edit-btn" href="update-enrollment-form.php?student_id=<?= htmlspecialchars($row['student_id']); ?>">
                                    Edit
                                </a>
                                
                                <form action="../database/db_delete_student.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');" class="d-inline">
                                    <input type="hidden" name="student_id" value="<?= htmlspecialchars($row['student_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                                </form>           
                                                   
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No students available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
    </div>

    <!-- KINDERGARTEN 1 FORM -->
    <div class="container mt-4">
        <h1 class="text-center">KINDERGARTEN 1 STUDENT</h1>
            <table id="kindergarten1-list" class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Middle Inital</th>
                        <th>Last Name</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kindergarten1_students)): ?>
                        <?php foreach ($kindergarten1_students as $row): ?>
                        <tr>
                        <td><?= htmlspecialchars($row['student_id']) ?></td>
                        <td><?= htmlspecialchars($row['first_name']) ?></td>
                        <td><?= htmlspecialchars($row['middle_name']) ?></td>
                        <td><?= htmlspecialchars($row['last_name']) ?></td>
                            <td>

                                <a class="btn btn-warning btn-sm edit-btn" href="update-enrollment-form.php?student_id=<?= htmlspecialchars($row['student_id']); ?>">
                                    Edit
                                </a>
                                
                                <form action="../database/db_delete_student.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');" class="d-inline">
                                    <input type="hidden" name="student_id" value="<?= htmlspecialchars($row['student_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                                </form>           
                                                   
                            </td>
                        </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No students available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
    </div>

        <!-- KINDERGARTEN 2 FORM -->
        <div class="container mt-4">
        <h1 class="text-center">KINDERGARTEN 2 STUDENT</h1>
            <table id="kindergarten2-list" class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Middle Inital</th>
                        <th>Last Name</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($kindergarten2_students)): ?>
                    <?php foreach ($kindergarten2_students as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['student_id']) ?></td>
                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                            <td><?= htmlspecialchars($row['middle_name']) ?></td>
                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm edit-btn" href="update-enrollment-form.php?student_id=<?= htmlspecialchars($row['student_id']); ?>">
                                    Edit
                                </a>
                                
                                <form action="../database/db_delete_student.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');" class="d-inline">
                                    <input type="hidden" name="student_id" value="<?= htmlspecialchars($row['student_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                                </form>           
                                                   
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No students available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
