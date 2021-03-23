<?php
    include('config/constants.php');
?>
<html>
    <head>
        <title>Task Manager with PHP</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/style.css">
    </head>
    <body>
        <div class="menu">
            <a href="<?php echo SITEURL; ?>index.php">Home</a>
        </div>
        <h3>Add Task Page</h3>
        <p>
            <?php
                if(isset($_SESSION['add_fail'])){
                    echo $_SESSION['add_fail'];
                    unset($_SESSION['add_fail']);
                }
            ?>
        </p>
        <form method="POST" action="">
            <table>
                <tr>
                    <td>Task Name:</td>
                    <td><input type="text" name="task_name" palceholder="Type your task name here" required="requied" ></td>
                </tr>
                <tr>
                    <td>Task Description:</td>
                    <td><textarea name="task_desc" palceholder="Type your task name here" required="requied" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td>Select List:</td>
                    <td>
                        <select name="list_id" id="">
                            <?php
                                $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
                                $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
                                $sql = "SELECT * FROM tbl_lists";
                                $res = mysqli_query($conn,$sql);
                                if($res == true){
                                    $count_rows = mysqli_num_rows($res);
                                    if($count_rows){
                                        while($row = mysqli_fetch_assoc($res)){
                                            $list_id = $row['list_id'];
                                            $list_name = $row['list_name'];
                                            ?>
                                                <option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                            <option value="0">None</option>
                                        <?php
                                    }
                                }else{
                                    header('location:'.SITEURL.'manage-list.php');
                                }
                            ?>
                            <option value="1">To do</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Priority:</td>
                    <td>
                        <select name="priority" id="">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Deadline:</td>
                    <td><input type="date" name="deadline"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Save"></td>
                </tr>

            </table>
        </form>

    </body>
</html>

<?php
    if(isset($_POST['submit'])){
        $task_name = $_POST['task_name'];
        $task_desc = $_POST['task_desc'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];

        $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        $db_select2 = mysqli_select_db($conn2,DB_NAME) or die(mysqli_error());
        $sql2 = "INSERT INTO tbl_tasks SET
                    task_name = '$task_name',
                    task_desc = '$task_desc',
                    list_id = '$list_id',
                    piority = '$priority',
                    deadline = '$deadline'
                ";
        $res2 = mysqli_query($conn2,$sql2);

        if($res2 == true){
            $_SESSION['add'] = "Task added Successfully.";
            header('location:'.SITEURL);
        } 

        else{
            $_SESSION['add_fail'] = "Failed to add Successfully.";
            header('location:'.SITEURL.'add-task.php');
        }
    }
?>