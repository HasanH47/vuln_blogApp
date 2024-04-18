<!-- edit_profile.php -->
<?php
include("db.php");
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// if ($_SESSION['id'] != $userId) {
//   echo "You are not authorized to edit this profile.";
//   exit();
// }

// Mengambil informasi pengguna saat ini
// $userId = $_SESSION['user_id'];
$userId = $_GET['id'];
$sqlUserInfo = "SELECT * FROM users WHERE id = '$userId'";
$resultUserInfo = $conn->query($sqlUserInfo);

if ($resultUserInfo->num_rows > 0) {
  $userInfo = $resultUserInfo->fetch_assoc();
} else {
  echo "User not found.";
  exit();
}
if (isset($_POST['submit'])) {
  $newUsername = $_POST['new_username'];
  $newPassword = $_POST['new_password'];

  // Perbarui username dan password
  $updateSql = "UPDATE users SET username = '$newUsername', password = '$newPassword' WHERE id = '$userId'";
  $updateResult = $conn->query($updateSql);

  if ($updateResult) {
    $_SESSION['username'] = $newUsername; // Perbarui nama pengguna di sesi
    header("Location: index.php");
    exit();
  } else {
    echo "Update failed.";
  }
}
$title = "Edit Profile";
include_once("includes/header.php");
?>

<div class="container mt-4">
  <h2>Edit Profile</h2>
  <!-- <form action="edit_profile.php" method="post"> -->
    <form action="edit_profile.php?id=<?php echo $userId; ?>" method="post">
      <input type="hidden" name="id" value="<?php echo $userId; ?>">
      <div class="form-group">
        <label for="current_username">Current Username:</label>
        <input type="text" class="form-control" id="current_username" name="current_username" value="<?php echo $userInfo['username']; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="current_password">Current Password:</label>
        <input type="password" class="form-control" id="current_password" name="current_password" value="<?php echo $userInfo['password']; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="new_username">New Username:</label>
        <input type="text" class="form-control" id="new_username" name="new_username" required>
      </div>
      <div class="form-group">
        <label for="new_password">New Password:</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<?php include_once("includes/footer.php"); ?>