<?php
session_start();
session_unset();
session_destroy();
setcookie("remember_user", "", time() - 3600, "/"); // Clear cookie if used
require_once '../config.php';

header("Location: ".BASE_URL."/controller/index.php");
exit();