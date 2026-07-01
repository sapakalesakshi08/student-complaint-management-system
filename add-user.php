<?php
include("db.php");

$error = "";
$success = "";

if(isset($_POST['add'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Backend Validation
    if(empty($name) || empty($email) || empty($password)){
        $error = "All fields are required!";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email format!";
    }
    elseif(strlen($password) < 6){
        $error = "Password must be at least 6 characters!";
    }
    else{

        // Check duplicate email
        $check = $conn->query("SELECT * FROM users WHERE email='$email'");

        if($check->num_rows > 0){
            $error = "Email already exists!";
        }
        else{

            // Hash Password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $conn->query("INSERT INTO users(name,email,password,role)
                          VALUES('$name','$email','$hashedPassword','user')");

            $success = "User added successfully!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #494a4e0c, #545257);
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar{
            position: fixed;
            width: 240px;
            height: 100%;
            background: rgba(0,0,0,0.85);
            padding: 25px 15px;
            color: white;
            box-shadow: 5px 0 20px rgba(0,0,0,0.2);
        }

        .sidebar h3{
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar a{
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 12px;
            border-radius: 12px;
            transition: 0.3s;
            font-size: 16px;
        }

        .sidebar a:hover{
            background: linear-gradient(45deg, #9c27b0, #e91e63);
            transform: translateX(5px);
        }

        /* Main Content */
        .main{
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Card */
        .add-card{
            background: rgba(255,255,255,0.95);
            width: 100%;
            max-width: 450px;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        .add-card:hover{
            transform: translateY(-5px);
        }

        .add-card h3{
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #333;
        }

        /* Inputs */
        .form-control{
            border-radius: 12px;
            padding: 12px;
            border: 2px solid #ddd;
            margin-bottom: 18px;
            transition: 0.3s;
        }

        .form-control:focus{
            border-color: #9c27b0;
            box-shadow: none;
        }

        /* Button */
        .btn-custom{
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(45deg, #9c27b0, #e91e63);
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-custom:hover{
            transform: translateY(-2px);
            opacity: 0.9;
        }

        /* Alerts */
        .alert{
            border-radius: 10px;
        }

        /* Responsive */
        @media(max-width:768px){

            .sidebar{
                width: 100%;
                height: auto;
                position: relative;
            }

            .main{
                margin-left: 0;
                padding-top: 30px;
            }
        }

    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

    <h3>Admin Panel</h3>

    <a href="admin-dashboard.php">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="logout.php">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>

<!-- Main -->
<div class="main">

    <div class="add-card">

        <h3>Add User</h3>

        <!-- Error Message -->
        <?php if($error): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <!-- Success Message -->
        <?php if($success): ?>
            <div class="alert alert-success">
                <?= $success ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" onsubmit="return validateForm()">

            <input type="text"
                   id="name"
                   name="name"
                   class="form-control"
                   placeholder="Enter Full Name">

            <input type="email"
                   id="email"
                   name="email"
                   class="form-control"
                   placeholder="Enter Email">

            <input type="password"
                   id="password"
                   name="password"
                   class="form-control"
                   placeholder="Enter Password">

            <button type="submit"
                    name="add"
                    class="btn-custom">
                Add User
            </button>

        </form>

    </div>

</div>

<!-- JS Validation -->
<script>

function validateForm(){

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;

    if(name === "" || email === "" || password === ""){
        alert("All fields are required!");
        return false;
    }

    if(password.length < 6){
        alert("Password must be at least 6 characters!");
        return false;
    }

    return true;
}

</script>

</body>
</html>