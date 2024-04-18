<?php
// register.php
include("db.php");
session_start();

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
  $result = $conn->query($sql);

  if ($result) {
    echo "Registration successful!";
  } else {
    echo "Registration failed.";
  }
}
$title = "Register";
include_once("includes/header.php");
?>

<div class="container mt-4">
  <h2>Register</h2>
  <form action="register.php" method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" name="register" class="btn btn-primary">Register</button>
  </form>
</div>

<?php include_once("includes/footer.php"); ?>