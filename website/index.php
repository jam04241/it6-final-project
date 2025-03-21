<!DOCTYPE html>
<html lang="en">
<head>
    <!-- LOGIN FORM -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- STYLE FOR WATAPAMPA -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ECF1FF;
        }
        .container {
            display: flex;
            width: 800px;
            height: 600px;
            border-radius:20px;
            overflow: hidden;
        }
        .left {
            width: 35%;
            background: url('../images/background.png') no-repeat center/cover;
        }
        .right {
            width: 65%;
            background-color: #143D60;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .logo {
            width: 300px;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #00796A;
            color: white;
        }
        .btn-custom:hover {
            background-color: #148f77;
        }
        h1{
            color: #FFF;
            text-align: center;
            font-family: Tinos;
            font-size: 25px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
        }
        .form-group{
            color: #FFF;
            font-family: Montserrat;
            font-size: 20px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }
        .form-control{
            width: 450px;
            height: 36px;
            flex-shrink: 0;
        }    
    </style>

</head>
<body>
    <div class="container">
        <div class="left"></div>
        <div class="right text-center">
            <img src="../images/SCHOOL_LOGO.png" alt="School Logo" class="logo">
            <h1>ADMIN</h1>
                <form action="../database/db_login.php" method="POST">
                <div class="w-100 text-start">
                    <div class="form-group">
                        <label for="username" class="form-label" text-left>Username</label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="right text-center">
                    <button class="btn btn-custom w-100 my-1" type="submit" >LOGIN</button>
                    <div class="signup">
                        <a href="signin.php" class="text-white">Go to Signup</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
