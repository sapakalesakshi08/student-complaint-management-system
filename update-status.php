<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("db.php");

$id = $_GET['id'];

if (isset($_POST['update'])) {

    $status = $_POST['status'];

    $conn->query("UPDATE complaints SET status='$status' WHERE id=$id");

    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        header("Location: admin-dashboard.php");
    } else {
        header("Location: staff-dashboard.php");
    }

    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Status</title>

    <!-- Bootstrap -->
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

    <h3>Update Complaint Status</h3>

    <form method="POST">

        <select name="status" required>
            <option value="">Select Status</option>
            <option value="Pending">Pending</option>
            <option value="Solved">Solved</option>
        </select>

        <button name="update">Update</button>

    </form>

    <a href="staff-dashboard.php" class="back-link">← Back to Dashboard</a>

</div>

</body>
</html>