<!-- create_post.php -->
<?php
include("db.php");
session_start();

if ($_SESSION['role'] !== 'admin') {
  header("Location: index.php");
  exit();
}

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $author_id = $_SESSION['user_id'];

  $sql = "INSERT INTO posts (title, content, author_id, created_at) VALUES ('$title', '$content', '$author_id', NOW())";
  $result = $conn->query($sql);

  if ($result) {
    header("Location: index.php");
    exit();
  } else {
    echo "Post creation failed.";
  }
}
$title = "Create Post";
include_once("includes/header.php");
?>

<div class="container mt-4">
  <h2>Create New Post</h2>
  <form action="create_post.php" method="post">
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
      <label for="content">Content:</label>
      <textarea class="form-control" id="content" name="content" rows="6" required></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Create Post</button>
  </form>
</div>

<?php include_once("includes/footer.php"); ?>