<?php 
    include('config/constants.php');
?>
<html>
    <head>Task Manager with PHP</head>
    <body>
        <h1>Task Manager</h1>
        <div class="menu">
            <a href="<?php echo SITEURL; ?>">Home</a>
            <a href="">To Do</a>
            <a href="">Doing</a>
            <a href="">Done</a>
            <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
        </div>
        <p>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
        </p>
        <div class="all-tasks">
        <a href="<?php echo SITEURL; ?>add-task.php">Add Task</a>
        <table>
            <tr>
                <th>S.N</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
            <?php
                $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
                $db_select = mysqli_select_db($conn,DB_NAME);
        
                $sql = "SELECT * FROM tbl_tasks";
        
                $res = mysqli_query($conn,$sql);

                if($res == true){
                    $count_rows = mysqli_num_rows($res);
                     $sn = 1;
                    if($count_rows>0)
                    {
                        while($row=mysqli_fetch_assoc($res)){
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['piority'];
                            $deadline = $row['deadline']
                        ?> 
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="http://">Update</a>
                                    <a href="http://">Delete</a>  
                                </td>
                            </tr>
                       <?PHP
                       }
                        
                        
                    }
                    else
                    {
                       ?> 
                            <tr>
                                <td colspan="5">No Tasks Added.</td>
                            </tr>
                       <?PHP
                    }
                }
            ?>

            
        </table>
            
        </div>
    </body>
</html>