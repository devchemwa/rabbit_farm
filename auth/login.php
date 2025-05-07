<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'; ?>
<body>
<?php include '../includes/navbar.php'; ?>  

<div class="container-fluid">
<div class="login-form">
  <form action="validate.php" method="post">
<div class="username">
  <input type="text" name="username" id="username" placeholder="Username">
</div>
<div class="password">
  <input type="password" name="password" id="password" placeholder="Password">
</div>
<div class="login">
  <input type="submit" name="submit" id="submit" >
</div>
</form>
</div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>