<?
session_start();
if (isset($_SESSION['uname'])) {
  header("Location:upload.php");
}
echo "USENAME :" . $_SESSION['uname'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/login.css">
  <script src="js/jquery-3.7.0.js"></script>
  <title>Document</title>
</head>

<body>
  <form class="box" method="post" action="login-check.php">
    <span class="errorlogin"></span>
    <i class="far fa-user"></i>
    <input type="text" name="uname" placeholder="UserName">
    <input type="password" name="pass" placeholder="Password">
    <input type="submit" value="ورود">
  </form>
  <!-- <script src="js/login.js"></script> -->
</body>

</html>