<?php
    include('config/constants.php');

    if($_GET['task_id']){
        $task_id = $_GET['task_id'];

        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        $sql = "DELETE FROM tbl_tasks WHERE task_id =$task_id";
        $res = mysqli_query($conn,$sql);
        if($res == true){
            $_SESSION['delete'] = "Task deleted successfully.";
            header('location:'.SITEURL);
        }else{
            $_SESSION['delete_failed'] = "Failed to delete task.";
            header('location:'.SITEURL);
        }
    }else{
        header('location:'.SITEURL);
    }
?>