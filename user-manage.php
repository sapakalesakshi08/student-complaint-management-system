<?php
include("db.php");

$users = $conn->query("SELECT * FROM users WHERE role='user'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    

<h2 class="p-3">User Management</h2>

<table class="table table-bordered">
<tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Action</th>
</tr>

<?php while($row = $users->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td>
        <a href="edit-user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
        <a href="delete-user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
           onclick="return confirm('Delete this user?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>