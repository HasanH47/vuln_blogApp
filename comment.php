<?php
// comment.php
include("db.php");
session_start();

if (isset($_POST['comment'])) {
  $post_id = $_POST['post_id'];
  $comment = $_POST['comment'];
  $username = $_SESSION['username'];

  $sql = "INSERT INTO comments (post_id, username, content) VALUES ($post_id, '$username', '$comment')";
  $result = $conn->query($sql);

  if ($result) {
    header("Location: detail.php?id=$post_id");
  } else {
    echo "Comment submission failed.";
  }
}
