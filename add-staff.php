<?php
include("db.php");

$error = "";
$success = "";

if(isset($_POST['add'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $department = trim($_POST['department']);

    // 🔴 Backend Validation
    if(empty($name) || empty($email) || empty($password) || empty($department)){
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
        $check = $conn->query("SELECT * FROM staff WHERE email='$email'");
        if($check->num_rows > 0){
            $error = "Email already exists!";
        } else {

            // Insert
            $conn->query("INSERT INTO staff (name,email,password,role,department)
                          VALUES('$name','$email','$password','staff','$department')");

            $success = "Staff added successfully!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Staff</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
}

/* Sidebar */
.sidebar {
    position: fixed;
    width: 230px;
    height: 100%;
    background: #2f2f2f;
    padding: 20px;
    color: white;
}

.sidebar a {
    display: block;
    color: white;
    padding: 10px;
    margin: 8px 0;
    text-decoration: none;
    border-radius: 8px;
    transition: 0.3s;
}

.sidebar a:hover {
    background: #9c27b0;
}

/* Main */
.main {
    margin-left: 250px;
    padding: 30px;
}

/* Card */
.card {
    border-radius: 12px;
}
</style>

</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="admin-dashboard.php">🏠 Dashboard</a>
    <a href="add-user.php">➕ Add User</a>
    <a href="add-staff.php">➕ Add Staff</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- Main -->
<div class="main">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card p-4 shadow">
                <h3 class="text-center mb-3">Add Staff</h3>

                <!-- Messages -->
                <?php if($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <?php if($success): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>

                <form method="POST" onsubmit="return validateForm()">

                    <input type="text" id="name" name="name" class="form-control mb-3" placeholder="Full Name">

                    <input type="email" id="email" name="email" class="form-control mb-3" placeholder="Email">

                    <input type="password" id="password" name="password" class="form-control mb-3" placeholder="Password">

                    <input type="text" id="department" name="department" class="form-control mb-3" placeholder="Department">

                    <button class="btn btn-primary w-100" name="add">Add Staff</button>

                </form>
            </div>

        </div>
    </div>
</div>

</div>

<!-- JS Validation -->
<script>
function validateForm(){

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let department = document.getElementById("department").value.trim();

    if(name === "" || email === "" || password === "" || department === ""){
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