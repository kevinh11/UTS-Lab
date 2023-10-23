
<?php
   setcookie('username', '', time()- 3600);
   setcookie('loggedIn', true , time()-3600);
   setcookie('userId', $user_id, time() -3600);

   header("Location: login.php");

?>