<?php
include("db.php");

$email = $_GET['email'];

if(isset($_POST['update']))
{
    $password = $_POST['password'];

    mysqli_query($conn,"
    UPDATE users
    SET password='$password',
        otp=NULL
    WHERE email='$email'
    ");

    echo "<script>
    alert('Password Updated Successfully');
    window.location='signindemo.php';
    </script>";
}
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Same Theme Style -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #494a4e0c, #545257);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .update-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        .update-card:hover {
            transform: translateY(-5px);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 2px solid #ddd;
            margin-bottom: 20px;
        }

        select:focus {
            border-color: #9c27b0;
            outline: none;
        }
        .form-control {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
}

.form-control:focus {
    border-color: #9c27b0;
    box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.15);
    background: white;
}

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(45deg, #9c27b0, #e91e63);
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #9c27b0;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
    </head>
    <body>
        <div class="update-card">

<form method="post">

    <h3>Reset Password</h3>

    <input type="password"
           name="password"
           placeholder="New Password" class="form-control" required>
           <br><br>


    <button type="submit" name="update">
        Update Password
    </button>

</form>
</div>
</body>
</html>
