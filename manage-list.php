<?php 
    include('config/constants.php');
?>
<html>
    <head>Task Manager</head>
    <body>
        <h1>Tasks</h1>
        <a href="<?php echo SITEURL; ?>">Home</a>
        <div class="all-lists">
            <a href="<?php echo SITEURL; ?>add-list.php">Add list</a>
            <p>
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>
            </p>
            <table>
                <tr>
                    <th>S.N</th>
                    <th>List Name</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                    $sql = "SELECT * FROM tbl_lists";
                    $res = mysqli_query($conn,$sql);
                    if($res == true){
                        $count_rows = mysqli_num_rows($res);
                        $sn = 1;
                        if($count_rows>0)
                        {
                            while($row=mysqli_fetch_assoc($res)){
                                $list_id = $row['list_id'];
                                $list_name = $row['list_name'];
                            ?> 
                                <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $list_name; ?></td>
                                        <td>
                                            <a href="">Update</a>
                                            <a href="">Delete</a>
                                        </td>
                                </tr>
                           <?PHP
                           }
                            
                            
                        }
                        else
                        {
                           ?> 
                                <tr>
                                    <td colspan="3">No List Added.</td>
                                </tr>
                           <?PHP
                        }
                    }
                ?>
                
            </table>
        </div>
    </body>
</html>