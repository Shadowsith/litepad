<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   $_SESSION['valid'] = false;
   header('Refresh: 2; URL = login.php');
   header('Location: login.php');
?>
