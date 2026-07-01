<?php

// Start session only once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("db.php");

// Prevent browser cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Protect page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'staff') {
    header("Location: signindemo.php");
    exit();
}

// Get department
$dept = $_SESSION['department'];

// Count complaints
$pending = $conn->query("
    SELECT * FROM complaints
    WHERE status='Pending' AND department='$dept'
")->num_rows;

$solved = $conn->query("
    SELECT * FROM complaints
    WHERE status='Solved' AND department='$dept'
")->num_rows;

// Fetch complaints with student name
$result = $conn->query("
    SELECT complaints.*, users.name AS student_name
    FROM complaints
    JOIN users ON complaints.user_id = users.id
    WHERE complaints.department='$dept'
");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 230px;
            height: 100%;
            background: #2f2f2f;
            padding: 20px;
            color: white;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #9c27b0;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .card {
            border-radius: 12px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>Staff Panel</h4>

    <a href="staff-dashboard.php">🏠 Dashboard</a>
    
    <a href="contact.php">📞 Contact Us</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">

<div class="welcome-card d-flex justify-content-between align-items-center mb-4">
    
    <div>
        <h3 class="mb-1 fw-bold">
            Welcome, <?php echo $_SESSION['user_name']; ?> 👋
        </h3>
        <p class="mb-0 text-muted">
            <?php echo $_SESSION['department']; ?> Department
        </p>
    </div>
</div>

<!-- Stats -->
<div class="row my-4">
    <div class="col-md-6">
        <div class="card p-3 bg-warning text-white">
            <h4>Pending: <?php echo $pending; ?></h4>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-3 bg-success text-white">
            <h4>Solved: <?php echo $solved; ?></h4>
        </div>
    </div>
</div>

<!-- Complaint Table -->
<table class="table table-bordered">
    <th>ID</th>
<th>Student</th>
<th>Complaint</th>
<th>Date & Time</th>
<th>Status</th>
<th>Action</th>
    <?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['student_name']; ?></td>
    <td><?php echo $row['complaint']; ?></td>

    <td>
        <?php echo date('d-m-Y h:i A', strtotime($row['created_at'])); ?>
    </td>

    <td>
        <?php if($row['status'] == 'Pending'): ?>
            <span class="badge bg-warning">Pending</span>
        <?php else: ?>
            <span class="badge bg-success">Solved</span>
        <?php endif; ?>
    </td>

    <td>
        <a href="update-status.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
            Update
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>

</div>
<script>
window.history.pushState(null, null, window.location.href);
window.onpopstate = function () {
    window.history.pushState(null, null, window.location.href);
};
</script>

</body>
</html>