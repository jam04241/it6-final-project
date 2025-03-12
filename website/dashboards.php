<?php
include '../database/dbconnect.php'; 

// Fetch student population by category
$student_query = "SELECT enroll_category, COUNT(*) AS count FROM tbl_student_info WHERE enroll_category IN ('Nursery', 'Kindergarten_1', 'Kindergarten_2') GROUP BY enroll_category;";
$student_result = mysqli_query($conn, $student_query);
$student_data = [];
while ($row = mysqli_fetch_assoc($student_result)) {
    $student_data[$row['enroll_category']] = $row['count'];
}

//Total Employees query
$employee_query = "SELECT COUNT(*) AS total_employees FROM tbl_employee";
$employee_result = mysqli_query($conn, $employee_query);
$employee_row = mysqli_fetch_assoc($employee_result);
$total_employees = $employee_row['total_employees'];

// Fetch yearly and monthly revenue
$yearly_query = "SELECT SUM(total) AS yearly_revenue FROM tbl_payment WHERE YEAR(date_created) = YEAR(CURDATE())";
$yearly_result = mysqli_query($conn, $yearly_query);
$yearly_revenue = mysqli_fetch_assoc($yearly_result)['yearly_revenue'] ?? 0;

$monthly_query = "SELECT SUM(total) AS monthly_revenue FROM tbl_payment WHERE YEAR(date_created) = YEAR(CURDATE()) AND MONTH(date_created) = MONTH(CURDATE())";
$monthly_result = mysqli_query($conn, $monthly_query);
$monthly_revenue = mysqli_fetch_assoc($monthly_result)['monthly_revenue'] ?? 0;

// Fetch male and female population
$male_query = "SELECT COUNT(*) AS male_count FROM tbl_student_info WHERE sex = 'Male'";
$female_query = "SELECT COUNT(*) AS female_count FROM tbl_student_info WHERE sex = 'Female'";
$male_result = mysqli_query($conn, $male_query);
$female_result = mysqli_query($conn, $female_query);
$male_population = mysqli_fetch_assoc($male_result)['male_count'] ?? 0;
$female_population = mysqli_fetch_assoc($female_result)['female_count'] ?? 0;

// Fetch admin and staff count
$admin_query = "SELECT COUNT(*) AS admin_count FROM tbl_employee WHERE employee_position = 'Administrator'";
$staff_query = "SELECT COUNT(*) AS staff_count FROM tbl_employee WHERE employee_position IN ('Cashier', 'Admission')";
$admin_result = mysqli_query($conn, $admin_query);
$staff_result = mysqli_query($conn, $staff_query);
$admin_count = mysqli_fetch_assoc($admin_result)['admin_count'] ?? 0;
$staff_count = mysqli_fetch_assoc($staff_result)['staff_count'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../style/dashboard-style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <?php include "../Layouts/navbar.php"?>

    <div class="container">
        <h1 class="text-center mt-3">DASHBOARD</h1>
        <div class="dashboard-container">
            <!-- Left Section (Student Population Chart) -->
            <div class="dashboard-left">
                <canvas id="studentChart"></canvas>
            </div>

            <!-- Right Section (Statistics) -->
            <div class="dashboard-right">
                <div class="card p-3 text-center">
                    <h5>Employee</h5>
                    <h3><?php echo $total_employees; ?></h3>
                </div>
                <div class="card p-3 text-center">
                    <h5>Powered by:</h5>
                    <i class="fa-brands fa-figma fa-3x"></i>
                </div>
                <div class="card p-3 text-center">
                    <h5><i class="fas fa-chart-line"></i> Yearly Revenue</h5>
                    <h3>₱<?php echo number_format($yearly_revenue, 2); ?></h3>
                </div>
                <div class="card p-3 text-center">
                    <h5><i class="fas fa-chart-line"></i> Monthly Revenue</h5>
                    <h3>₱<?php echo number_format($monthly_revenue, 2); ?></h3>
                </div>
                <div class="card p-3 text-center">
                    <h5><i class="fa-solid fa-person"></i> Male Students</h5>
                    <h3><?php echo $male_population; ?></h3>
                </div>
                <div class="card p-3 text-center">
                    <h5><i class="fa-solid fa-person-dress"></i> Female Students</h5>
                    <h3><?php echo $female_population; ?></h3>
                </div>
                <div class="card p-3 text-center">
                    <h5><i class="fa-solid fa-user-tie"></i> Admin</h5>
                    <h3><?php echo $admin_count; ?></h3>
                </div>
                <div class="card p-3 text-center">
                    <h5><i class="fa-solid fa-user"></i> Staff</h5>
                    <h3><?php echo $staff_count; ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <img src="../images/FOOTER.png" alt="Footer" class="footer-img">
    </div>

    <script>
        // Pie Chart
        const ctx = document.getElementById('studentChart').getContext('2d');
        const studentChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_keys($student_data)); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_values($student_data)); ?>,
                    backgroundColor: ['#007bff', '#ffc107', '#ff5722']
                }]
            }
        });
    </script>
</body>
</html>
