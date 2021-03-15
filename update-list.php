<?php
    include('config/constants.php');

    if($_GET['list_id']){
        $list_id = $_GET['list_id'];
        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
        $sql = "SELECT * FROM tbl_lists WHERE list_id = $list_id";
        $res = mysqli_query($conn,$sql);
        if($res == true){
            $row = mysqli_fetch_assoc($res);
            $list_name=$row['list_name'];
            $list_desc=$row['list_desc'];
        }else{
            header('location:'.SITEURL.'manage-list.php');
        }
    }
?>
<html>
    <head>
        <title>Task Manager with PHP</title>
    </head>
    <body>
        <div class="menu">
            <a href="<?php echo SITEURL; ?>index.php">Home</a>
            <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
        </div>
        <h3>Update List Page</h3>
        <p>
            <?php
                if(isset($_SESSION['update_fail'])){
                    echo $_SESSION['update_fail'];
                    unset($_SESSION['update_fail']);
                }
            ?>
        </p>
        <form method="POST" action="">
            <table>
                <tr>
                    <td>List Name:</td>
                    <td><input type="text" name="list_name" palceholder="Name here" required="requied" value="<?php echo $list_name ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="list_desc" cols="30" rows="10"><?php echo $list_desc ?></textarea></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Update"></td>
                </tr>

            </table>
        </form>

    </body>
</html>
<?php 
    if(isset($_POST['submit'])){
        $list_name = $_POST['list_name'];
        $list_desc = $_POST['list_desc'];

        $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn2,DB_NAME) or die(mysqli_error());
        $sql2 = "UPDATE tbl_lists SET 
        list_name='$list_name',
        list_desc='$list_desc'
        WHERE list_id = $list_id";
        $res2 = mysqli_query($conn2,$sql2);

        if($res2 == true){
            $_SESSION['update'] = "Updated Successfully.";
            header('location:'.SITEURL.'manage-list.php');
        } 

        else{
            $_SESSION['update_fail'] = "Failed to add Successfully.";
            header('location:'.SITEURL.'update-list.php?list_id='.$list_id);
        }
    }
?>