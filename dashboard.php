<?php
// Start session only once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Prevent browser cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

include("db.php");
// Protect page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: signindemo.php");
    exit();
}

// Get logged in user id
$user_id = $_SESSION['user_id'];

// Count complaints
$total = $conn->query("
    SELECT * FROM complaints 
    WHERE user_id = $user_id
")->num_rows;

$pending = $conn->query("
    SELECT * FROM complaints 
    WHERE user_id = $user_id 
    AND status='Pending'
")->num_rows;

$solved = $conn->query("
    SELECT * FROM complaints 
    WHERE user_id = $user_id 
    AND status='Solved'
")->num_rows;

// Fetch complaints
$result = $conn->query("
    SELECT * FROM complaints 
    WHERE user_id = $user_id 
    ORDER BY id DESC
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
    <title>Student Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background: #2f2f2f;
            color: white;
            padding-top: 20px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #ccc;
            padding: 12px 20px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #444;
            color: #fff;
        }

        /* Main Content */
        .main {
            margin-left: 240px;
            padding: 30px;
        }

        /* Cards */
        .card {
            border-radius: 15px;
            border: none;
        }

        .card h3 {
            font-weight: bold;
        }

        /* Table */
        table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        /* Top Bar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-btn {
            background: crimson;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: darkred;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>Student Panel</h4>

    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="add-complaint.php">➕ Add Complaint</a>
    <a href="about.php">ℹ️ About Us</a>
    <a href="contact.php">📞 Contact Us</a>
  
    <a href="feedback.php">💬 Feedback</a>
    <a href="logout.php">🚪 Logout</a>
</div>
<!-- Main Content -->
<div class="main">

    <!-- Top Bar -->
    <div class="welcome-card d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="mb-1 fw-bold">
            Welcome, <?php echo $_SESSION['user_name']; ?> 👋
        </h3>

        <p class="mb-0 text-muted">
            Student Dashboard
        </p>
    </div>
</div>
    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card p-3 bg-primary text-white">
                <h5>Total Complaints</h5>
                <h3><?php echo $total; ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 bg-warning text-white">
                <h5>Pending</h5>
                <h3><?php echo $pending; ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 bg-success text-white">
                <h5>Solved</h5>
                <h3><?php echo $solved; ?></h3>
            </div>
        </div>
    </div>

    <!-- Add Complaint Button -->
    <a href="add-complaint.php" class="btn btn-primary mb-3">+ Add Complaint</a>

    <!-- Complaint Table -->
    <table class="table table-bordered">
        <tr>
    <th>ID</th>
    <th>Complaint</th>
    <th>Department</th>
    <th>Status</th>
    <th>Date & Time</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['complaint']; ?></td>
    <td><?php echo $row['department']; ?></td>

    <td>
        <?php if($row['status'] == 'Pending'): ?>
            <span class="badge bg-warning">Pending</span>
        <?php else: ?>
            <span class="badge bg-success">Solved</span>
        <?php endif; ?>
    </td>

    <td>
        <?php echo date('d-m-Y h:i A', strtotime($row['created_at'])); ?>
    </td>
</tr>
<?php endwhile; ?>
    </table>

</div>
<script>
window.history.pushState(null, null, window.location.href);
window.onpopstate = function () {
    window.history.pushState(null, null, window.location.href);
    window.addEventListener('pageshow',function(event){
        if(event.persisted){
            window.location.reload();
        }
    }
};
</script>

</body>
</html>