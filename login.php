<?php
// login.php
include("db.php");
session_start();

// if (isset($_POST['login'])) {
//   $username = $_POST['username'];
//   $password = $_POST['password'];

//   $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
//   $stmt = $conn->prepare($sql);

//   $stmt->bind_param("ss", $username, $password);
//   $stmt->execute();
//   $result = $stmt->get_result();

//   if ($result->num_rows > 0) {
//     $user = $result->fetch_assoc();
//     $_SESSION['username'] = $user['username'];
//     $_SESSION['role'] = $user['role'];
//     $_SESSION['user_id'] = $user['id'];
//     header("Location: index.php");
//     exit();
//   } else {
//     echo "Login failed.";
//   }

//   $stmt->close();
// }

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['user_id'] = $user['id'];
    header("Location: index.php");
  } else {
    echo "Login failed.";
  }
}

$title = "Login";
include_once("includes/header.php");
?>

<div class="container mt-4">
  <h2>Login</h2>
  <form action="login.php" method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" name="login" class="btn btn-primary">Login</button>
  </form>
</div>

<?php include_once("includes/footer.php"); ?>