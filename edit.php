<?php
    include('components/header.php');
    include('components/navbar.php');
?>
<body>
    <div class="container">
        <h1 class="mt-4">Edit To Do</h1>

        <?php
            $con = mysqli_connect("localhost", "root", "", "todo_list");

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if (isset($_GET['edit'])) {
                $q2 = "SELECT * FROM todo_items WHERE task_id='". $_GET['edit'] ."'";
                $query2 = mysqli_query($con, $q2);

                if (mysqli_num_rows($query2) > 0) {
                    $data_lama = mysqli_fetch_assoc($query2);
                } else {
                    echo "Data not found.";
                }
            }
        ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="task_name" class="form-label">Task Name:</label>
                <input type="text" name="task_name" id="task_name" class="form-control" value="<?php echo $data_lama['task_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="task_status" class="form-label">Task Status:</label>
                <select name='task_status' id='task_status' class="form-select">
                    <option value='Not started' <?php echo ($data_lama['task_status'] == 'Not started') ? 'selected' : ''; ?>>Not started</option>
                    <option value='Waiting on' <?php echo ($data_lama['task_status'] == 'Waiting on') ? 'selected' : ''; ?>>Waiting on</option>
                    <option value='In progress' <?php echo ($data_lama['task_status'] == 'In progress') ? 'selected' : ''; ?>>In progress</option>
                    <option value='Completed' <?php echo ($data_lama['task_status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Update" class="btn btn-primary">
        </form>

        <?php
            if (isset($_POST['submit'])) {
                $task = $_POST['task_name'];
                $status = $_POST['task_status'];

                $sql = "UPDATE todo_items SET task_name ='$task', task_status ='$status' WHERE task_id='" . $data_lama['task_id'] . "'";
                if (mysqli_query($con, $sql)) {
                    header("Location: ToDoList.php");
                    exit();
                } else {
                    echo "Error updating record: " . mysqli_error($con);
                }
            }

            mysqli_close($con);
        ?>
    </div>
</body>
</html>
