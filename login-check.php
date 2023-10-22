<?
require_once('common.php');
require_once('db.php');
$u = strtolower($_POST['uname']);
$p = $_POST['pass'];
$db = Db::getInstance();



$record = getFirst($u, $p);
if ($record == null) {
    if (isset($_POST['uname'])) {
        $ar['abc'] = "نام کاربری یا رمز عبور اشتباه وارد شده است.";
        // header('/user/login.php', $ar);
    }
} else {
    $_SESSION['suname'] = $u;

    header("Location:page/home/");
}
