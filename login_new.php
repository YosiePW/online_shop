<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="
    https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  </head>
  <body>

    <div class="login">
      <div class="avatar">
        <i class="fa fa-user"></i>
      </div>

      <h2>Login Form</h2>




      <?php
      if (isset($_SESSION["message"])): ?>
        <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
          <?php echo $_SESSION["message"]["message"]; ?>
          <?php unset($_SESSION["message"]); ?>
        </div>
      <?php endif; ?>
      <form action="proses_login_new.php" method="post">

        <div class="box-login">
          <i class="fas fa-envelope"></i>
          <input type="text" name="username" class="form-control mb-2" placeholder="Email" required>
        </div>

        <div class="box-login">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn-login">Login</button>

      </form>

    </div>
  </body>
</html>
