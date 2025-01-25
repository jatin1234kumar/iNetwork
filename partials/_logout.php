<?php 

session_start();
session_unset();
session_destroy();

header("location: /projects/forum/index.php?logout=true");
exit();

?>