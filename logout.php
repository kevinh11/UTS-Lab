
<?php
   setcookie('username', '', time()- 3600);
   setcookie('loggedIn', true , time()-3600);
   setcookie('userId', 0, time() -3600);

   header("Location: login.php");

?>