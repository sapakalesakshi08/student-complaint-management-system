<?php
session_start();
include("db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $complaint = $_POST['complaint'];
    $department = $_POST['department'];
    $user_id = $_SESSION['user_id'];

    if (empty($complaint) || empty($department)) {
        echo "All fields required!";
        exit();
    }

    $sql = "INSERT INTO complaints (complaint, department, status, user_id)
            VALUES ('$complaint', '$department', 'Pending', '$user_id')";

    if ($conn->query($sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Complaint</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Your Same CSS -->
    <link rel="stylesheet" href="auth-style.css">
</head>

<body>

<div class="container-fluid d-flex align-items-center justify-content-center min-vh-100">

    <div class="auth-card w-100" style="max-width: 500px;">

        <div class="text-center mb-4">
            <h2 class="fw-bold">Add Complaint</h2>
            <p class="text-muted">Submit your issue easily</p>
        </div>

        <!-- Form -->
        <form method="POST">

            
            <div class="mb-4">
                <label class="form-label fw-semibold">Department</label>
                <select name="department" class="form-control" required>
                    <option value="">Select Department</option>
                    <option>Technical</option>
                    <option>Infrastructure</option>
                    <option>Canteen</option>
                    <option>Hygiene</option>
                    <option>Security</option>
                    <option>Hostel</option>
                    <option>Discipline</option>
                    <option>Transport</option>
                    <option>Academic</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Complaint</label>
                <textarea name="complaint" class="form-control" rows="4" placeholder="Describe your issue..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                Submit Complaint
            </button>

        </form>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="dashboard.php" class="text-primary fw-semibold">← Back to Dashboard</a>
        </div>

    </div>

</div>
<script>

document.getElementById("loginForm").addEventListener("submit", function() {

    setTimeout(() => {
        document.getElementById("loginForm").reset();
    }, 100);

});

</script>
</body>
</html>