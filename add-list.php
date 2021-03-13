<?php
    include('config/constants.php');
?>
<html>
    <head>
        <title>Task Manager with PHP</title>
    </head>
    <body>
        <a href="<?php echo SITEURL; ?>index.php">Home</a>
        <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>

        <h3>Add List Page</h3>

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
                    <td>List Name:</td>
                    <td><input type="text" name="list_name" palceholder="Name here" required="requied"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><input type="text" name="list_desc" palceholder="Description here"></td>
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
        $list_name = $_POST['list_name'];
        $list_desc = $_POST['list_desc'];

        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn,DB_NAME);

        $sql = "INSERT INTO tbl_lists SET
                list_name = '$list_name',
                list_desc = '$list_desc'
        ";

        $res = mysqli_query($conn,$sql);
        if($res == true){
            $_SESSION['add'] = "List added Successfully.";
            header('location:'.SITEURL.'manage-list.php');
        } 

        else{
            $_SESSION['add_fail'] = "Failed to add Successfully.";
            header('location:'.SITEURL.'add-list.php');
        }
    }
?>
