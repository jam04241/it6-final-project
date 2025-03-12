<?php
    include "../helpers/session.php";
?>

<!-- NAVBAR -->
    <nav class="navbar navbar-custom d-flex align-items-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
            <i class="bi bi-list menu-icon"></i> 
        </button>
        <div class="ms-auto dropdown">
            <a class="profile-icon" href="#" id="profileDropdown" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i> 
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="enrollmentDropdown">
                <li><a class="dropdown-item" aria-disabled="true">Hi! <?php echo htmlspecialchars($username); ?></a></li>
                <li><a class="dropdown-item" href="../helpers/logout_handler.php" onclick="return confirmation()">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="navbar-border"></div>

    <!-- SIDEBAR -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="Logo">
                <img src="../images/SCHOOL_LOGO.png" alt="Profile Image">
            </div>
            <ul>
                <li><a href="../website/dashboards.php"><i class="fa-solid fa-gauge"></i>Dashboard</a></li>
                 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="enrollmentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-journal"></i> Student
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="enrollmentDropdown">
                        <li><a class="dropdown-item" href="../website/add-registration-form.php"><i class="fa-solid fa-cash-register"></i>Registration</a></li>
                        <li><a class="dropdown-item" href="../website/student-enrollment.php"><i class="fa-solid fa-file-contract"></i>Enrollment</a></li>
                        <li><a class="dropdown-item" href="../website/student-listing.php"><i class="fa-solid fa-people-group"></i>List</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="enrollmentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-journal"></i> Tutor
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="enrollmentDropdown">
                        <li><a class="dropdown-item" href="../website/add-registration-form.php"><i class="fa-solid fa-cash-register"></i>Registration</a></li>
                        <li><a class="dropdown-item" href="../website/student-enrollment.php"><i class="fa-solid fa-people-group"></i>List</a></li>
                    </ul>
                </li>

                <li><a href="../website/payment-information.php"><i class="bi bi-cash-stack"></i> Payment</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="enrollmentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-tie"></i>Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="enrollmentDropdown">
                        <li><a class="dropdown-item" href="../website/audit-log.php"><i class="fa-solid fa-clock-rotate-left"></i>Audit Log</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-people"></i>Staff</a></li>
                    </ul>
                </li>
                
            </ul>
            <div class="divider"></div>
        </div>
    </div>

        <!-- STYLE FOR NAVBAR AND SIDEBAR -->
        <style>
            .dropdown-item wowex.disabled {
            pointer-events: none; /* Prevents clicking */
            opacity: 1 !important; /* Ensures text is visible */
            color: #000 !important; /* Keeps text dark */
        }
        body {
            background-color: #d3d7df;
            margin: 0;
            padding: 0;
        }
        .navbar-custom {
            background-color: #00324e;
            padding: 12px 20px;
        }
        .navbar-border {
            height: 3px;
            background-color: #0088cc;
        }
        .menu-icon, .profile-icon {
            font-size: 30px;
            color: white;
            cursor: pointer;
            margin: 180px;
        }
        .navbar-toggler{
            border: none;
            padding: 5px;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }
        .offcanvas {
            width: 255px;
            background-color: #012641;
            color: white;
        }
        .offcanvas .Logo {
            text-align: center;
            margin-bottom: 15px;
        }
        .offcanvas .Logo img {
            width: 250px;
            height: 200px;
        }
        .offcanvas ul {
            padding: 0;
            list-style: none;
            margin-top: 20px;
        }
        .offcanvas ul li {
            padding: 12px 20px;
            font-size: 20px;
        }
        .offcanvas ul li a {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .offcanvas ul li:hover {
            background-color: #02486b;
        }
        .divider {
            width: 80%;
            height: 2px;
            background-color: white;
            margin: 20px auto;
        }
        .dropdown-menu {
        background-color: #023047; /* Blue background */
        border: none; /* Remove border */
        }

        .dropdown-item {
            color: white; /* White text */
        }

        .dropdown-item:hover {
            background-color: #02486b; /* Darker blue on hover */
            color: #fff; /* Ensure text stays white */
        }
    </style>
    
    <script>
        function confirmation(){
            function confirmation() {
            var result = confirm('Do you want to logout?');
            if (result) {
                alert('You Logout Thank you for using the school system');
                window.location.href = '../website/index.php';
            } else {
                return false;
            }
        }
    }
    </script>
        
