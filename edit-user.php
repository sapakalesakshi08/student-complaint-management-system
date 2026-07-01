<?php
include("db.php");

$id = $_GET['id'];
$error = "";

// Fetch data
$data = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Validation
    if(empty($name) || empty($email)){
        $error = "All fields are required!";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email format!";
    }
    else{
        $conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
        header("Location: admin-dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: Arial;
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
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
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
                <h3 class="text-center mb-3">Edit User</h3>

                <!-- Error -->
                <?php if($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST">

                    <input type="text" name="name" class="form-control mb-3"
                           value="<?= $data['name'] ?>" placeholder="Full Name">

                    <input type="email" name="email" class="form-control mb-3"
                           value="<?= $data['email'] ?>" placeholder="Email">

                    <button class="btn btn-primary w-100" name="update">
                        Update User
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

</div>

</body>
</html>