<?php
  include('components/header.php');
?>

<body class='container-fluid d-flex flex-column justify-content-center align-items-center'>
  <h1>Login</h1>
  <form method='POST'>
    <div class='loginform d-flex flex-column align-items-start justify-content-center'>
      <label for='signUpUname'>Username</label>
      <input required type='text' name='loginName'>
    </div>
    <div class='mt-3 loginform d-flex flex-column align-items-start justify-content-center'>
      <label for='signUpPass'>Password</label>
      <input required type='password' name='loginPass'>
    </div>

    <input type='submit' class='mt-3 btn btn-primary' value='Login'></input>

    <p>
      Don't have an account? <a href='signup.php'>Sign Up Now</a>
    </p>
  </form>

  <?php
    session_start();
    include('components/connection.php');

    $query = "SELECT user_name, user_pass, user_id FROM Users";
    $get_users = $conn->prepare($query);
    $get_users->execute();
    $users = $get_users->fetchAll();

    function get_user_id($loginName, $loginPass) { 
      global $users;
      foreach ($users as $user) {
        if ($user['user_name'] === $loginName && $user['user_pass'] === $loginPass) {
          return $user['user_id'];
        }
      }
      return -1;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $loginName = $_POST['loginName']; 
      $loginPass = $_POST['loginPass'];

      $user_id = get_user_id($loginName, $loginPass);

      if ($user_id != -1) {

        global $user_data;
        $user_info = array(
          'id'=> $user_id,
          'name'=> $_POST['loginName']
        );

        setcookie('userId', $user_id, time() + (86400 * 7));
        setcookie('username', $user_info['name'], time() + (86400 * 7));
        setcookie('loggedIn', true, time() + (86400 * 7)); 
        header('Location: todo.php');
      } 
      
      else {
        echo '<p class="text-danger">Invalid username or password. Remember, details are case sensitive</p>';
      }
    }
  ?>
</body>
</html>