<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To-Do-List</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>To-Do-List</h1>
        <form action="ToDoList.php" method="POST">
            <input type="text" name="task" style="width: 300px; height: 30px;">
            <input type="submit" value="simpen" style="background-color: blue; color: white; height: 30px;">
        </form>
        
        <?php
            $con = mysqli_connect("localhost", "root", "", "todo_list");

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if (isset($_POST['task'])) {
                $task = $_POST['task'];

                $q1 = "INSERT INTO todo_items (task_name) VALUES ('$task')";
                $query_insert = mysqli_query($con, $q1);

                if (!$query_insert) {
                    die("Insertion failed: " . mysqli_error($con));
                }
            }

            $q2 = "SELECT * FROM todo_items ORDER BY 
                        CASE 
                            WHEN task_status = 'Completed' THEN 3 
                            WHEN task_status = 'In progress' THEN 2 
                            WHEN task_status = 'Waiting on' THEN 1 
                            ELSE 0 
                        END ASC, task_id DESC";
            $q3 = "SELECT COUNT(*) as count FROM todo_items";
            $query_display = mysqli_query($con, $q2);
            $query_count = mysqli_query($con, $q3);

            echo "<table class='todolist'>";
            echo "<tr>";
            echo "<th>No</th>";
            echo "<th>Task</th>";
            echo "<th>Done</th>";
            echo "<th>Delete</th>";
            echo "<th>Edit</th>";
            echo "<th>progress</th>";
            echo "</tr>";

            while ($hasil = mysqli_fetch_array($query_display)) {
                echo "<tr>";
                echo "<td>" . $hasil['task_id'] . "</td>"; 
                echo "<td>" . $hasil['task_name'] . "</td>"; 
                echo "<td><a href='ToDoList.php?done=" . $hasil['task_id'] . "'>V</a></td>";
                echo "<td><a href='ToDoList.php?delete=" . $hasil['task_id'] . "'>X</a></td>";
                echo "<td><a href='edit.php?edit=" . $hasil['task_id'] . "'><input type='submit' value='Edit'> </a></td>";
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
    </body>
</html>