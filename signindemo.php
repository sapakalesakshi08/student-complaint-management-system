<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($email) || empty($password) || empty($role)) {
        $error = "Please fill all fields!";
    } else {

        // ================= USER =================
        if ($role == 'user') {
            $sql = "SELECT * FROM users WHERE email='$email' AND role='user'";
        }

        // ================= STAFF =================
        elseif ($role == 'staff') {
    $sql = "SELECT * FROM staff WHERE email='$email'";
}
        // ================= ADMIN =================
        elseif ($role == 'admin') {
            $sql = "SELECT * FROM admins WHERE email='$email'";
        }

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {

            $user = $result->fetch_assoc();

            // Password check (simple OR hashed)
            if ($password == $user['password'] || password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['role'] = $role;

                // Staff department
                if ($role == 'staff') {
                    $_SESSION['department'] = $user['department'];
                }

                // Redirect
                if ($role == 'admin') {
                    header("Location: admin-dashboard.php");
                } elseif ($role == 'staff') {
                    header("Location: staff-dashboard.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit();

            } else {
                $error = "Incorrect password!";
            }

        } else {
            $error = "Invalid $role credentials!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="auth-style.css">
</head>

<body>
    <a href="home.php" class="back-link">← Go Back</a>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="auth-card" style="max-width:400px; width:100%;">

        <h2 class="text-center mb-3">Sign In</h2>

        <!-- Error Message -->
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Login Form -->
    <form method="POST" id="loginForm">
            
     <div class="mb-3">
        <label>Login As</label>
        <select name="role" class="form-control" required>
                 <option value="">Select Role</option>
                 <option value="user">Student</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
        </select>
    </div> 

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" id="loginPass" class="form-control" placeholder="Enter password" required>
            </div>

            <!-- Forgot Password -->
            <div class="text-end mb-3">
                
                <a href="forgot_paasword.php" class="text-decoration-none">Forgot Password?</a>
            </div>
            

           <button type="submit" class="btn btn-primary w-100" onclick="reloadPage()">Login</button>
         
        </form>

        <!-- Create Account -->
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="regs.php">Create Account</a></p>
        </div>

    </div>
</div>

</body>
<script>
    document.getElementById("loginForm").addEventListener("submit", function(e) {

    let email = document.querySelector("input[name='email']");
    let password = document.querySelector("input[name='password']");

    if (email.value.trim() === "") {
        alert("Email is required!");
        email.focus();
        e.preventDefault();
    }

    if (password.value.trim() === "") {
        alert("Password is required!");
        password.focus();
        e.preventDefault();
    }
    let role = document.querySelector("select[name='role']");

    if (role.value === "") {
    alert("Please select role!");
    e.preventDefault();
    }

    
});
</script>
<script>

document.getElementById("loginForm").addEventListener("submit", function() {

    setTimeout(() => {
        document.getElementById("loginForm").reset();
    }, 100);

});

</script>

</html>