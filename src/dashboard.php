<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header("Location: login.php"); exit;
}
?>
<!doctype html><html><body>
  <h1>Welcome <?= htmlspecialchars($_SESSION['user_firstname']) ?></h1>
  <p>This is the dashboard.</p>
  <p><a href="index.php">Home</a></p>
</body></html>
