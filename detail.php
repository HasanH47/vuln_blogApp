<?php
// detail.php
include("db.php");
session_start();

if (isset($_GET['id'])) {
  $post_id = $_GET['id'];
  $sql = "SELECT posts.id, posts.title, posts.content, posts.created_at, users.username as author
            FROM posts
            JOIN users ON posts.author_id = users.id
            WHERE posts.id = $post_id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();

    // Fetch comments for the post
    $commentSql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC";
    $commentResult = $conn->query($commentSql);
  } else {
    echo "Post not found.";
  }
}

// get posts title name
$title = $post['title'];
include_once("includes/header.php");
?>

<div class="container mt-3">
  <h1><?php echo $post['title']; ?></h1>
  <p>Author: <?php echo $post['author']; ?></p>
  <p>Date: <?php echo $post['created_at']; ?></p>
  <p><?php echo $post['content']; ?></p>

  <!-- Display comments -->
  <h2>Comments:</h2>
  <?php while ($comment = $commentResult->fetch_assoc()) : ?>
    <div>
      <!-- html entities -->
      <!-- <p><?php echo htmlspecialchars($comment['content']); ?></p> -->
      <p><?php echo $comment['content']; ?></p>
      <p>By: <?php echo $comment['username']; ?> - <?php echo $comment['created_at']; ?></p>
    </div>
    <hr>
  <?php endwhile; ?>

  <!-- Add comment form -->
  <?php if (isset($_SESSION['username'])) : ?>
    <form action="comment.php" method="post">
      <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
      <label for="comment">Leave a Comment:</label>
      <textarea name="comment" rows="4" cols="50" required></textarea>
      <br>
      <input type="submit" name="submit_comment" value="Submit Comment">
    </form>
  <?php else : ?>
    <p>Login to leave a comment.</p>
  <?php endif; ?>
</div>
<?php include_once("includes/footer.php"); ?>