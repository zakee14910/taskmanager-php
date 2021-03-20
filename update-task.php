<?php
    include('config/constants.php');

    if($_GET['task_id']){
        $task_id = $_GET['task_id'];

        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        $sql = "SELECT * FROM tbl_tasks WHERE task_id =$task_id";
        $res = mysqli_query($conn,$sql);
        if($res == true){
            $row = mysqli_fetch_assoc($res);
            $task_name=$row['task_name'];
            $task_desc=$row['task_desc'];
            $priority=$row['piority'];
            $deadline=$row['deadline'];
            $list_id = $row['list_id'];
        }else{
            header('location:'.SITEURL);
        }
    }else{
        header('location:'.SITEURL);
    }
?>
<html>
    <head>
        <title>Task Manager with PHP</title>
    </head>
    <body>
        <div class="menu">
            <a href="<?php echo SITEURL; ?>index.php">Home</a>
        </div>
        <h3>Update Task Page</h3>
        <form method="POST" action="">
            <table>
                <tr>
                    <td>Task Name:</td>
                    <td><input type="text" name="task_name" value="<?php echo $task_name?>" required="requied" ></td>
                </tr>
                <tr>
                    <td>Task Description:</td>
                    <td><textarea name="task_desc" required="requied" cols="30" rows="10"><?php echo $task_desc?></textarea></td>
                </tr>
                <tr>
                    <td>Select List:</td>
                    <td>
                        <select name="list_id" >
                            <?php
                                $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
                                $db_select2 = mysqli_select_db($conn2,DB_NAME) or die(mysqli_error());
                                $sql2 = "SELECT * FROM tbl_lists";
                                $res2 = mysqli_query($conn2,$sql2);
                                if($res2 == true){
                                    $count_rows2 = mysqli_num_rows($res2);
                                    if($count_rows2){
                                        while($row2 = mysqli_fetch_assoc($res2)){
                                            $list_id_db = $row2['list_id'];
                                            $list_name = $row2['list_name'];
                                            ?>
                                                <option <?php if($list_id_db == $list_id){echo "selected='selected'";}?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
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
                            <option value="1">To do</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Priority:</td>
                    <td>
                        <select name="priority" id="">
                            <option <?php if($priority == "High"){echo "selected='selected'";}?> value="High">High</option>
                            <option <?php if($priority == "Medium"){echo "selected='selected'";}?> value="Medium">Medium</option>
                            <option <?php if($priority == "Low"){echo "selected='selected'";}?> value="Low">Low</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Deadline:</td>
                    <td><input type="date" name="deadline" value="<?php echo $deadline?>"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Update"></td>
                </tr>

            </table>
        </form>

    </body>
</html>