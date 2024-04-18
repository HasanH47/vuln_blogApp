<!-- promote_user.php -->
<?php
include("db.php");
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}

if (isset($_GET['id'])) {
  $userId = $_GET['id'];

  // Perbarui peran pengguna menjadi admin
  $updateSql = "UPDATE users SET role = 'admin' WHERE id = '$userId'";
  $updateResult = $conn->query($updateSql);

  if ($updateResult) {
    header("Location: manage_users.php");
    exit();
  } else {
    echo "Promotion failed.";
  }
} else {
  echo "Invalid request.";
}
?>