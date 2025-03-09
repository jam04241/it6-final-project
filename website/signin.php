<?php
include 'helpers/not_authenticated.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ECF1FF;
        }
        .container-box { 
            display: flex;
            width: 800px;
            height: 700px;
            border-radius: 20px;
            overflow: hidden;
        }
        .left {
            width: 65%;
            background-color: #143D60;
            padding: 30px;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .right {
            width: 35%;
            background: url('../images/background.png') no-repeat center/cover;
        }
        .logo {
            width: 200px;
            margin-bottom: 1px;
        }
        .form-group {
            width: 100%;
            color: #FFF;
            font-family: Montserrat;
            font-size: 15px;
            font-weight: 500;
        }
        .form-label {
            color: #FFF;
            font-family: Montserrat;
            font-size: 18px;
            font-weight: 500;
        }
        .form-control {
            border-radius: 8px;
            background-color: #fff;
            border: none;
            padding: 8px;
            width: 100%;
            height: 36px;
        }
        .btn-custom {
            background-color: #17a589;
            color: white;
            width: 100%;
            border-radius: 10px;
            padding: 10px;
            font-weight: bold;
            margin-top: 10px;
        }
        .btn-custom:hover {
            background-color: #148f77;
        }
        h1 {
            color: #FFF;
            text-align: center;
            font-family: Monsterrats;
            font-size: 24px;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container-box">
        <div class="left">
            <img src="../images/SCHOOL_LOGO.png" alt="School Logo" class="logo">
            <h1>SIGN IN</h1>
            <!-- Employee Position -->
            <form action="../database/db_signin.php" method="POST">
                <div class="w-100">
                    <div class="form-group mb-2">
                        <div class="col-md-4">
                            <label for="employee_position" class="form-label">Employee Position</label>
                            <select type="text" id="employee_position" name="employee_position" class="form-control">
                               <option value="" selected disabled>Select</option>
                               <option value="Administrator">Administrator</option>
                               <option value="Admission">Admission</option>
                               <option value="Cashier">Cashier</option> 
                            </select>
                        </div>
                    </div>

                    <!-- Name Fields -->
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="middlename" class="form-label">Middle Initial</label>
                            <input type="text" id="middle_name" name="middle_name" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control">
                        </div>
                    </div>
                    <!-- User and Pass -->
                    <div class="form-group mt-2">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="re-enter" class="form-label">Re-enter Password</label>
                        <input type="password" id="verify_pass" name="verify_pass" class="form-control">
                    </div>
                    <!-- Buttons -->
                    <div class="text-center my-3">
                        <button class="btn btn-custom w-50" type="submit">Sign In</button>
                        <div class="login">
                            <a href="index.php" class="text-white">Go to Login</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="right"></div>
    </div>
</body>
</html>
