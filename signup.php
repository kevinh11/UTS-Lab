
<?php
  include('components/header.php')

?>
<body class = 'container-fluid d-flex flex-column justify-content-center align-items-center'>
  <h1>Sign Up</h1>
  <form method='POST'>
    <div class='loginform d-flex flex-column align-items-start justify-content-center'>
      <label for='signUpUname'>Username</label>
      <input required type='text' name='signUpUname'>
    </div>
    <div class='mt-3 loginform d-flex flex-column align-items-start justify-content-center'>
      <label for='signUpPass'>Password</label>
      <input id='signUpPass' required type='password' name='signUpPass'>
    </div>
    <div class='mt-3 loginform d-flex flex-column align-items-start justify-content-center'>
      <label for='signUpUname'>Confirm password</label>
      <input id='signUpConfirm' required type='password' name='signUpPassConfirm'>
    </div>

    <input id='submit-form' type='submit' class='mt-3 btn btn-primary' value='Sign Up Now'></input>
    <p>
      Have an account? 
      <a href='login.php'>Log in</a>
    </p>
  </form>

  <?php
include('components/connection.php');

session_start();

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['signUpPass'] === $_POST['signUpPassConfirm']) {
        $_SESSION['attempts'] = 0;

        $sql = "INSERT INTO USERS(user_name, user_pass) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $data = [$_POST['signUpUname'], $_POST['signUpPass']];
        $stmt->execute($data);
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['attempts']++;

        if ($_SESSION['attempts'] > 0) {
          echo '<p class="text-danger">Failed to make account. Make sure the passwords match!</p>';
        }
    }
}
?>


  <script src='scripts/signup.js'>
</body>
</html>