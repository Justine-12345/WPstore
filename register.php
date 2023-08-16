<?php
session_start();

if(isset($_SESSION['userInfo'])){
 echo'<script>window.location="http://localhost/wpstore/index.php";</script>';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>WP|Register</title>

<?php include('./css/outstyle.php'); ?>
</head>
<body>

<div class="bg"> 
<?php 
include('./includes/navout.php');
?>

<div style="width: 80%; margin: auto; text-align: left; margin-top: 50px" >
<form action="user.php" method="post" >

  <div class="form-row">
    <div class="form-group ">
      <label for="inputEmail4">First Name</label>
      <input type="text" name="userFName" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group ">
      <label for="inputPassword4">Last Name</label>
      <input type="text" name="userLName" class="form-control" id="inputPassword4">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group ">
      <label for="inputEmail4">Email</label>
      <input type="email" name="userEmail" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group ">
      <label for="inputPassword4">Password</label>
      <input type="password" name="userPassword" class="form-control" id="inputPassword4">
    </div>
  </div>
  <br>
  <button type="submit" name="register" class="btn btn-primary">SIGN-UP</button>
</form>
</div>
</div>
</body>
</html>