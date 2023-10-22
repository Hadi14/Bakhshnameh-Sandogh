<?
require_once('common.php');
      $u = strtolower($_POST['uname']);
      $p = $_POST['pass'];
      $record = UserModel::getFirst($u, $p);
      if ($record == null) {
          if (isset($_POST['uname'])) {
              $ar['abc'] = "نام کاربری یا رمز عبور اشتباه وارد شده است.";
              Render::renderlogin('/user/login.php', $ar);
          }
      } else {
          // $msg = "<h4>تبریک شما به سیستم وارد شدید.</h4> <br> <span>برای ورود به صفحه اصلی<a href=" . getBaseUrl() . "page/home> اینجا </a>کلیک کنید</span>";
          $_SESSION['suname'] = $u;
          // $_SESSION['scope'] = $record['scope'];
          $_SESSION['level'] = $record['level'];
          $_SESSION['name'] = $record['name'];
          $_SESSION['family'] = $record['family'];
          $_SESSION['scope'] = $record['scope'];
          header("Location:" . getBaseUrl() . 'page/home/');
      }
  }