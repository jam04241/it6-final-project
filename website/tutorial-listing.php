    <?php 
    include "../database/dbconnect.php";

    try {
        if (!$conn) {
            die("Database connection failed: " . $conn->error);
        }

        // Array to store query results
        $tutorial_student = [];
        $kindergarten1_students = [];
        $kindergarten2_students = [];

        // Run each stored procedure separately with proper handling
        $queries = [
            "SELECT * FROM tbl_tutor_info WHERE isactive = 1;",
            "SELECT * FROM tbl_tutor_info;",
            "SELECT * FROM tbl_tutor_info"
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

        <!-- TUTOR LISTING -->
        <div class="container mt-4">
            <h1 class="text-center">TUTOR LISTING</h1>
                <table id="nursery-list" class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>TUTOR ID</th>
                            <th>First Name</th>
                            <th>Middle Inital</th>
                            <th>Last Name</th>
                            <th>Focus Subject</th>
                            <th>Time arrival</th>
                            <th>Grade level</th>
                            <th>School</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($nursery_students)): ?>
                        <?php foreach ($nursery_students as $row): ?>
                            <tr>
                            <td><?= htmlspecialchars($row['tutorial_id']) ?></td>
                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                            <td><?= htmlspecialchars($row['middle_name']) ?></td>
                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                            <td><?= htmlspecialchars($row['focus_subject']) ?></td>
                            <td><?= htmlspecialchars($row['time_arrival']) ?></td>
                            <td><?= htmlspecialchars($row['grade_level']) ?></td>
                            <td><?= htmlspecialchars($row['school']) ?></td>

                                <td>
                                <button type="button" class="btn btn-primary btn-sm view-student-btn" data-id="<?= htmlspecialchars($row['tutorial_id']) ?>" data-toggle="modal" data-target="#student-view">
                                    View
                                </button>
                                <a class="btn btn-warning btn-sm edit-btn" href="update-tutorial-form.php?tutorial_id=<?= htmlspecialchars($row['tutorial_id']); ?>">
                                        Edit
                                    </a>
                                    <form action="../database/db_delete_tutorial.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');" class="d-inline">
                                        <input type="hidden" name="tutorial_id" value="<?= htmlspecialchars($row['tutorial_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                                    </form>                        
                                </td>
                            </tr>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">No students available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
        </div>
        <!-- TUTORIAL View Modal -->
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
            var tutorialId = $(this).data("id"); // Get student ID from button

            $.ajax({
                url: "db_fetch_tutor.php",
                type: "POST",
                data: { tutorial_id: tutorialId },
                success: function(response) {
                    $("#student-info-body").html(response); // Load student data into modal
                }
            });
        });
    });
        </script>
    </html>
