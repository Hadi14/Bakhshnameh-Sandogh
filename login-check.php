<?
require_once('common.php');
require_once('db.php');
$u = strtolower($_POST['uname']);
$p = $_POST['pass'];
$db = Db::getInstance();



$record = getFirst($u, $p);
if ($record == null) {
    if (isset($_POST['uname'])) {
        $ar = "نام کاربری یا رمز عبور اشتباه وارد شده است.";
        header('loginadmin.php?error=' . $ar);
        echo $ar;
    }
} else {
    session_start();
    $_SESSION['uname'] = $u;
    header("Location:upload.php");
}
