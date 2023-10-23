<?php
    include('components/header.php');

?>
<body>
   <?php
    include('components/navbar.php');
   
   ?>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <h1 class="mt-4">To-Do List</h1>
        <form action="ToDoList.php" method="POST" class="mt-3">
            <div class="input-group mb-3 d-flex flex-row justify-content-center align-items-center">
                <input type="text" name="task" class="form-control" style="width: 300px; height: 30px;">
                <div class="input-group-append px-4">
                    <input type="submit" value="simpen" class="btn btn-primary"">
                </div>
            </div>
        </form>
        
        <?php

            if (!isset($_COOKIE['loggedIn'])) {
                header("Location:Login.php");
            }

            $uid = $_COOKIE['userId'];

            $con = mysqli_connect("localhost", "root", "", "todo_list");
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['task'])) {
                    $task = $_POST['task'];
                    
                    $q1 = "INSERT INTO todo_items (task_name,task_status,user_id) VALUES ('$task','not started',$uid)";
                    $query_insert = mysqli_query($con, $q1);
        
                    if (!$query_insert) {
                        die("Insertion failed: " . mysqli_error($con));
                    }
        
                    header("Location: ToDoList.php");
                    exit();
                }
            }

          
            $q2 = "SELECT * FROM todo_items WHERE user_id = $uid ORDER BY 
                        CASE 
                            WHEN task_status = 'Completed' THEN 3 
                            WHEN task_status = 'In progress' THEN 2 
                            WHEN task_status = 'Waiting on' THEN 1 
                            ELSE 0 
                        END ASC, task_id DESC";
            $q3 = "SELECT COUNT(*) as count FROM todo_items WHERE user_id = $uid";
            $query_display = mysqli_query($con, $q2);
            $query_count = mysqli_query($con, $q3);

            echo "<table class='table table-bordered table-striped mt-3'>";
            echo "<tr>";
            echo "<th>No</th>";
            echo "<th>Task</th>";
            echo "<th>Done</th>";
            echo "<th>Delete</th>";
            echo "<th>Edit</th>";
            echo "<th>Progress</th>";
            echo "</tr>";

            while ($hasil = mysqli_fetch_array($query_display)) {
                echo "<tr>";
                echo "<td>" . $hasil['task_id'] . "</td>"; 
                echo "<td>" . $hasil['task_name'] . "</td>"; 
                echo "<td><a href='ToDoList.php?done=" . $hasil['task_id'] . "'>V</a></td>";
                echo "<td><a href='ToDoList.php?delete=" . $hasil['task_id'] . "'>X</a></td>";
                echo "<td><a href='edit.php?edit=" . $hasil['task_id'] . "'><input class='btn btn-primary 'type='submit' value='Edit'> </a></td>";
                echo "<td>" . $hasil['task_status'] . "</td>"; 
                echo "</tr>";
            }

            $count = mysqli_fetch_array($query_count);
            echo "<tr>";
            echo "<th class='column-no'>Count: " . $count['count'] . "</th>";
            echo "</tr>";

            if(isset($_GET['delete'])){
                $q4 = "DELETE FROM todo_items WHERE task_id='".$_GET['delete']."'";
                $query_delete = mysqli_query($con, $q4);
            }

            if (isset($_GET['done'])) {
                $q5 = "UPDATE todo_items SET task_status='Completed' WHERE task_id='". $_GET['done'] ."'";
                $query_progress = mysqli_query($con, $q5);
            }

            mysqli_close($con);
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
