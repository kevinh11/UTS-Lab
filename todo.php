<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel='stylesheet' href='style.css'>
  <title>To Do List</title>
</head>
<body class = 'container-fluid d-flex flex-column justify-content-center align-items-center'>
  <?php
    include('components/navbar.php');

    
  ?>

  <h1>To Do List</h1>

  <form class='d-flex flex-row justify-content-center align-items-center' method='POST' action='todo.php'>
    <input id='todo-input' name='todo-item' placeholder='what do you want to do?'>
    <input type='submit' class='btn btn-primary'>

  </form>

  <table class='mt-4 table table-striped'>
    <thead>
      <tr>
        <td scope='col'>
          Item
        </td>
        <td scope='col'>
          Done
        </td>
      </tr>
    </thead>
    <tbody>
      <?php
        if (isset($_COOKIE['loggedIn'])) {
          print_r($_COOKIE);
        }
        else {
          header('Location: login.php');
        }

      
      

      
      
      ?>
    </tbody>
  </table>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>