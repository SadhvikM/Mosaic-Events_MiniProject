<?php
ob_start();
session_start();
unset($_SESSION['rainbow_mobile']);
unset($_SESSION['rainbow_username']);
unset($_SESSION['rainbow_email']);
unset($_SESSION['rainbow_user_id']);
unset($_SESSION['rainbow_address']);
echo '<script type="text/javascript">window.location="login.php"; </script>';
?>