<?php
// index.php
include("db.php");
session_start();

// if (isset($_POST['search'])) {
//   $search = $_POST['search'];
//   $sql = "SELECT posts.id, posts.title, posts.author_id, posts.created_at, users.username as author
//             FROM posts
//             JOIN users ON posts.author_id = users.id
//             WHERE posts.title LIKE '%$search%'
//             ORDER BY posts.created_at DESC";
// } else {
//   $sql = "SELECT posts.id, posts.title, posts.author_id, posts.created_at, users.username as author
//             FROM posts
//             JOIN users ON posts.author_id = users.id
//             ORDER BY posts.created_at DESC";
// }

$sql = "SELECT posts.id, posts.title, posts.author_id, posts.created_at, users.username as author
  FROM posts
  JOIN users ON posts.author_id = users.id
  ORDER BY posts.created_at DESC";

$result = $conn->query($sql);
$title = "Home";
include_once("includes/header.php");
?>

<div class="container mt-3">
  <h1>Welcome to the 47XBlog</h1>
  <div class="mb-3">
    <?php if (isset($_SESSION['username'])) : ?>
      <?php if ($_SESSION['role'] === 'admin') : ?>
        <a href="create_post.php" class="btn btn-primary">Add New Post</a>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <!-- Search Form -->
  <!-- <form action="index.php" method="post">
    <label for="search">Search:</label>
    <input type="text" name="search">
    <input type="submit" value="Search">
  </form> -->

  <?php while ($row = $result->fetch_assoc()) : ?>
    <div>
      <h2><?php echo $row['title']; ?></h2>
      <p>Author: <?php echo $row['author']; ?></p>
      <p>Date: <?php echo $row['created_at']; ?></p>
      <a href="detail.php?id=<?php echo $row['id']; ?>">View Details</a>
    </div>
    <hr>
  <?php endwhile; ?>
</div>

<?php include_once("includes/footer.php"); ?>