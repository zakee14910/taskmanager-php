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
        <div class="all-tasks">
        <a href="http://">Add Task</a>
        <table>
            <tr>
                <th>S.N</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Design</td>
                <td>Medium</td>
                <td>23/05/2020</td>
                <td>
                    <a href="http://">Update</a>
                    <a href="http://">Delete</a>  
                </td>
            </tr>
        </table>
            
        </div>
    </body>
</html>