<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password_raw = $_POST['password'];

    // Validation
    if (empty($name) || empty($email) || empty($password_raw)) {
        $error = "All fields are required!";
    } else {

        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $check_result = $stmt->get_result();

        if ($check_result->num_rows == 0) {

            // Hash password
            $password = password_hash($password_raw, PASSWORD_DEFAULT);

            // Insert user
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
            $stmt->bind_param("sss", $name, $email, $password);

            if ($stmt->execute()) {
                $success = "Account created successfully! <a href='signindemo.php'>Login now</a>";
            } else {
                $error = "Registration failed!";
            }

        } else {
            $error = "Email already exists!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="auth-style.css">
</head>

<body>
<a href="home.php" class="back-link">← Go Back</a>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="auth-card" style="max-width:450px; width:100%;">

        <h2 class="text-center mb-3">Sign Up</h2>

        <!-- Messages -->
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if(isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" id="registerForm">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name">
                <div class="invalid-feedback">Name is required</div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                <div class="invalid-feedback">Valid email required</div>
            </div>

            <div class="mb-3 position-relative">
                <label class="form-label">Password</label>
                <input type="password" name="password" id="regPass" class="form-control" placeholder="Create password">
                <div class="invalid-feedback">Minimum 6 characters</div>
            </div>

            <div class="mb-3 position-relative">
                <label class="form-label">Confirm Password</label>
                <input type="password" id="confirmPass" class="form-control" placeholder="Confirm password">
                <div class="invalid-feedback">Passwords must match</div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Create Account</button>

        </form>

        <div class="text-center mt-3">
            <p>Already have an account? 
                <a href="signindemo.php" class="text-primary fw-semibold">Sign In</a>
            </p>
        </div>

    </div>
</div>
    <script>
document.getElementById("registerForm").addEventListener("submit", function(e) {

    let name = document.getElementById("name");
    let email = document.getElementById("email");
    let password = document.getElementById("regPass");
    let confirmPass = document.getElementById("confirmPass");

    let isValid = true;

    // Reset
    [name, email, password, confirmPass].forEach(input => {
        input.classList.remove("is-invalid");
    });

    // Name
    if (name.value.trim() === "") {
        name.classList.add("is-invalid");
        isValid = false;
    }

    // Email
    if (email.value.trim() === "") {
        email.classList.add("is-invalid");
        isValid = false;
    }

    // Password length
    if (password.value.length < 6) {
        password.classList.add("is-invalid");
        isValid = false;
    }

    // Confirm password match
    if (password.value !== confirmPass.value) {
        confirmPass.classList.add("is-invalid");
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }
});
</script>

</body>
</html>
</body>
</html>