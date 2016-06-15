<?php

include 'ChromePhp.php';
// ChromePhp::log('Hello console!');
// ChromePhp::log($_SERVER);
// ChromePhp::warn('something went wrong!');

session_start();
ChromePhp::log($_SESSION['myusername']);
if (isset($_SESSION['myusername'])) {
    // header("location:login.php");
} else {
    header("location:login.php");
}
?>

<html>
    <body>
        Login Successful
    </body>
</html>
