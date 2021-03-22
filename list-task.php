<?php 
    include('config/constants.php');
    $list_id_url = $_GET['list_id'];
    
?>
<html>
    <head>Task Manager with PHP</head>
    <body>
        <h1>Task Manager</h1>
        <div class="menu">
            <a href="<?php echo SITEURL; ?>">Home</a>
            <?php
                $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
                $db_select2 = mysqli_select_db($conn2,DB_NAME) or die(mysqli_error());
                $sql2 = "SELECT * FROM tbl_lists";
                $res2 = mysqli_query($conn2,$sql2);
                if($res2 == true){
                    $count_rows2 = mysqli_num_rows($res2);
                    if($count_rows2){
                        while($row2 = mysqli_fetch_assoc($res2)){
                            $list_id = $row2['list_id'];
                            $list_name = $row2['list_name'];
                            ?>
                                <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                            <?php
                        }
                    }
                    else{
                        ?>
                            <option <?php if($list_id_db =0){echo "selected='selected'";}?> value="0">None</option>
                        <?php
                    }
                }else{
                    header('location:'.SITEURL.'manage-list.php');
                }
            ?>
        </div>
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
        
                $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";
        
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
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id?>">Update</a>
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id?>">Delete</a>  
                                </td>
                            </tr>
                       <?PHP
                       }
                        
                        
                    }
                    else
                    {
                       ?> 
                            <tr>
                                <td colspan="5">No Tasks Added on this list.</td>
                            </tr>
                       <?PHP
                    }
                }
            ?>

            
        </table>
            
        </div>
    </body>
</html>