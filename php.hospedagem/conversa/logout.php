<?php
// Exclui o cookie do usuário
setcookie("user_id", "", time() - 3600, "/");
header("Location: index.php");
exit();
?>