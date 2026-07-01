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
// Protect Admin Page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: signindemo.php");
    exit();
}

// Fetch Users
$users = $conn->query("SELECT * FROM users WHERE role='user'");

// Fetch Staff
$staff = $conn->query("SELECT * FROM staff WHERE role='staff'");

// Fetch Complaints
$complaints = $conn->query("
    SELECT complaints.*, users.name
    FROM complaints
    JOIN users ON complaints.user_id = users.id
");

// Dashboard Counts
$total_users = $conn->query("
    SELECT COUNT(*) as total 
    FROM users 
    WHERE role='user'
")->fetch_assoc()['total'];

$total_staff = $conn->query("
    SELECT COUNT(*) as total 
    FROM staff 
    WHERE role='staff'
")->fetch_assoc()['total'];

$total_complaints = $conn->query("
    SELECT COUNT(*) as total 
    FROM complaints
")->fetch_assoc()['total'];

$pending = $conn->query("
    SELECT COUNT(*) as total 
    FROM complaints 
    WHERE status='Pending'
")->fetch_assoc()['total'];

$solved = $conn->query("
    SELECT COUNT(*) as total 
    FROM complaints 
    WHERE status='Solved'
")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    margin:0;
    font-family: Arial;
    background:#f4f6f9;
}

/* Sidebar */
.sidebar{
    position:fixed;
    left:0;
    top:0;
    width:230px;
    height:100%;
    background:#2f2f2f;
    padding:20px;
    color:white;
}

.sidebar h4{
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
    transition:0.3s;
    cursor:pointer;
}

.sidebar a:hover{
    background:#9c27b0;
}

/* Main */
.main-content{
    margin-left:250px;
    padding:25px;
}

/* Cards */
.card{
    border-radius:15px;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

/* Tables */
.table-container{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    margin-top:20px;
}

/* Hide Sections */
.content-section{
    display:none;
}

.active-section{
    display:block;
}

</style>

</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

    <h4>Admin Panel</h4>

    <a onclick="showSection('dashboard')">🏠 Dashboard</a>

    <a onclick="showSection('users')">👨‍🎓 Manage Users</a>

    <a onclick="showSection('complaints')">📋 Manage Complaints</a>

    <a onclick="showSection('staff')">👨‍🏫 Manage Staff</a>

    <a href="logout.php">🚪 Logout</a>

</div>

<!-- Main Content -->
<div class="main-content">

    <!-- Dashboard -->
    <div id="dashboard" class="content-section active-section">

        <div class="row g-3">

            <div class="col-md-3">
                <div class="card text-white p-3" style="background:#9c27b0;">
                    <h6>Total Users</h6>
                    <h2><?= $total_users ?></h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white p-3" style="background:#673ab7;">
                    <h6>Total Staff</h6>
                    <h2><?= $total_staff ?></h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white p-3" style="background:#3f51b5;">
                    <h6>Total Complaints</h6>
                    <h2><?= $total_complaints ?></h2>
                </div>
            </div>

        </div>

        <div class="row mt-4">

            <div class="col-md-8">

                <div class="table-container">

                    <h4 class="mb-4">Complaint Statistics</h4>

                    <canvas id="complaintChart"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!-- User Section -->
    <div id="users" class="content-section">

        <div class="table-container">

            <h3 class="mb-4">User Management</h3>

            <a href="add-user.php" class="btn btn-success shadow-sm px-4">
                ➕ Add New User
            </a>

            <br><br>

            <table class="table table-bordered table-hover">

                <tr class="table-dark">
                    <th>Sr No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>

                <?php 
                $serial = 1;
                while($row = $users->fetch_assoc()): 
                ?>

                <tr>

                    <td><?= $serial++ ?></td>

                    <td><?= $row['name'] ?></td>

                    <td><?= $row['email'] ?></td>

                    <td>

                        <a href="edit-user.php?id=<?= $row['id'] ?>" 
                           class="btn btn-sm btn-primary">
                           Edit
                        </a>

                    </td>

                </tr>

                <?php endwhile; ?>

            </table>

        </div>

    </div>

    <!-- Staff Section -->
    <div id="staff" class="content-section">

        <div class="table-container">

            <h3 class="mb-4">Staff Management</h3>
            

            <table class="table table-bordered table-hover">

                <tr class="table-dark">
                    <th>Sr No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>

                <?php 
                $serial = 1;
                while($row = $staff->fetch_assoc()): 
                ?>

                <tr>

                    <td><?= $serial++ ?></td>

                    <td><?= $row['name'] ?></td>

                    <td><?= $row['email'] ?></td>

                    <td><?= $row['department'] ?></td>

                    <td>

                        <a href="edit-staff.php?id=<?= $row['id'] ?>"
                           class="btn btn-sm btn-primary">
                            Edit
                        </a>

                    </td>

                </tr>

                <?php endwhile; ?>

            </table>

        </div>

    </div>

    <!-- Complaint Section -->
    <div id="complaints" class="content-section">

        <div class="table-container">

            <h3 class="mb-4">Complaint Management</h3>

            <table class="table table-bordered table-hover">

                <tr class="table-dark">
                    <th>ID</th>
                    <th>User</th>
                    <th>Complaint</th>
                    <th>Department</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php while($row = $complaints->fetch_assoc()): ?>

                <tr>

                    <td><?= $row['id'] ?></td>

                    <td><?= $row['name'] ?></td>

                    <td><?= $row['complaint'] ?></td>

                    <td><?= $row['department'] ?></td>
                     <td>
        <?php echo date('d-m-Y h:i A', strtotime($row['created_at'])); ?>
    </td>

                    <td>

                        <?php if($row['status'] == 'Pending'): ?>

                            <span class="badge bg-warning text-dark px-3 py-2">
                                Pending
                            </span>

                        <?php elseif($row['status'] == 'Solved'): ?>

                            <span class="badge bg-success px-3 py-2">
                                Solved
                            </span>

                        <?php endif; ?>

                    </td>
                    
   

                    <td>

                        <a href="update-status.php?id=<?= $row['id'] ?>"
                           class="btn btn-sm btn-primary">
                           Update
                        </a>

                    </td>

                </tr>

                <?php endwhile; ?>

            </table>

        </div>

    </div>

</div>

<!-- JavaScript -->
<script>

function showSection(sectionId){

    let sections = document.querySelectorAll('.content-section');

    sections.forEach(section => {
        section.classList.remove('active-section');
    });

    document.getElementById(sectionId).classList.add('active-section');
}

</script>

<script>

const ctx = document.getElementById('complaintChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: ['Pending', 'Solved'],

        datasets: [{

            label: 'Complaints',

            data: [<?= $pending ?>, <?= $solved ?>],

            backgroundColor: [
                '#f44336',
                '#4caf50'
            ],

            borderColor: [
                '#d32f2f',
                '#388e3c'
            ],

            borderWidth: 2
        }]
    },

    options: {

        responsive: true,

        plugins: {
            legend: {
                display: true
            }
        },

        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

</body>
</html>