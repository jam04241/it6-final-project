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
    $active_students = [];
    $inactive_students = [];

    // Run each stored procedure separately with proper handling
    $queries = [
        
        // Nursery
        "SELECT
            student_id,
            first_name,
            middle_name,
            last_name
	    FROM
		    tbl_student_info
	    WHERE
		    enroll_category ='Nursery';",

        // Kindergarten 1
        "SELECT
            student_id,
            first_name,
            middle_name,
            last_name
        FROM
            tbl_student_info
        WHERE
            enroll_category ='Kindergarten_1';",

        // Kindergarten 2
        "SELECT
            student_id,
            first_name,
            middle_name,
            last_name
        FROM
            tbl_student_info
        WHERE
            enroll_category ='Kindergarten_2';",

        // active status
        "SELECT
            student_id,
            first_name,
            middle_name,
            last_name
        FROM
            tbl_student_info
        WHERE
            isactive = 1;",

        // inactive status
        "SELECT
            student_id,
            first_name,
            middle_name,
            last_name
        FROM
            tbl_student_info
        WHERE
            isactive = 0;"
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
                        } elseif ($index == 3) {
                            $active_students[] = $row;
                        } elseif ($index == 4) {
                            $inactive_students[] = $row;
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


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
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
                            <button type="button" class="btn btn-primary btn-sm view-student-btn" data-id="<?= htmlspecialchars($row['student_id']) ?>" data-toggle="modal" data-target="#student-view">
                                View
                            </button>
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

                            <button type="button" class="btn btn-primary btn-sm view-student-btn" data-id="<?= htmlspecialchars($row['student_id']) ?>" data-toggle="modal" data-target="#student-view">
                                View
                            </button>
                                </button>
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
                            <button type="button" class="btn btn-primary btn-sm view-student-btn" data-id="<?= htmlspecialchars($row['student_id']) ?>" data-toggle="modal" data-target="#student-view">
                                View
                            </button>
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

        <!-- ACTIVE FORM -->
        <div class="container mt-4">
        <h1 class="text-center">ACTIVE STUDENT</h1>
            <table id="nursery-list" class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Middle Inital</th>
                        <th>Last Name</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($active_students)): ?>
                    <?php foreach ($active_students as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['student_id']) ?></td>
                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                            <td><?= htmlspecialchars($row['middle_name']) ?></td>
                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                            <td>
                                <form action="../database/db_inactive_student.php" method="POST" onsubmit="return deactive('Are you sure you want to deactive this student?');" class="d-inline">
                                    <input type="hidden" name="student_id" value="<?= htmlspecialchars($row['student_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" > Deactive </button>
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

        <!-- DEACTIVE FORM -->
        <div class="container mt-4">
        <h1 class="text-center">INACTIVE STUDENT</h1>
            <table id="nursery-list" class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Middle Inital</th>
                        <th>Last Name</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($inactive_students)): ?>
                    <?php foreach ($inactive_students as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['student_id']) ?></td>
                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                            <td><?= htmlspecialchars($row['middle_name']) ?></td>
                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                            <td>
                                <form action="../database/db_active_student.php" method="POST" onsubmit="return active('Are you sure you want to active this student?');" class="d-inline">
                                    <input type="hidden" name="student_id" value="<?= htmlspecialchars($row['student_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-success btn-sm" > Active </button>
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

    <!-- Student View Modal -->
<div class="modal fade" id="student-view" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Student Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody id="student-info-body">
                        <!-- Student details will be inserted here via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <div class="footer">
        <img src="../images/FOOTER.png" alt="Footer" class="footer-img">
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
        }
    </script>

    <script>
       $(document).ready(function() {
    $(".view-student-btn").on("click", function() {
        var studentId = $(this).data("id"); // Get student ID from button

        $.ajax({
            url: "db_fetch_student.php",
            type: "POST",
            data: { student_id: studentId },
            success: function(response) {
                $("#student-info-body").html(response); // Load student data into modal
            }
        });
    });
});
    </script>
</html>
