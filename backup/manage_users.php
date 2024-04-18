<!-- manage_users.php -->
<?php
include("db.php");
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}

// Tampilkan semua pengguna
$sqlUsers = "SELECT * FROM users";
$resultUsers = $conn->query($sqlUsers);

$title = "Manage Users";
include_once("includes/header.php");
?>

  <div class="container mt-4">
    <h2>Manage Users</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $resultUsers->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
              <?php if ($row['role'] === 'user') : ?>
                <a href="promote_user.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Promote to Admin</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

<?php include_once("includes/footer.php"); ?>