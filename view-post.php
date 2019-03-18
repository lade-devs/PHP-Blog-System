<?php require('include/config.php');


?>

<!DOCTYPE>
<html>
<head>

    <title>View Blog Post | VeerDict</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

</head>
<body>
<a href="index.php"><- Home</a>
<center>
    <h5>ADMIN FUNCTIONS:</h5>
    <a href="add-new-post.php">Add new post</a><br/>
    <a href="view-post.php">View All post</a>
<br/>
    <form action="" method="post">
    <table style="margin-top:20px;" cellspacing="10" cellpadding="10" border="1px" bgcolor="#fff8dc">
        <thead>
            <th>S/N</th>
            <th>Post Title</th>
            <th>Description</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php
        // DELETING POST
        if(isset($_POST['delete_post'])){
            extract($_POST);
            $query_post =  new post_query();
            $query_post->delete_post($delete_post);
        }

        $db_query =new db_connect();
        $select = " SELECT * FROM `post` ";
        $run_post = mysqli_query($db_query->connection_start(),$select);
        $sn = 0;
        while( $row = mysqli_fetch_assoc($run_post) ) {
            $sn++;
        echo '
        <tr>
            <td>'.$sn.'</td>
            <td><a href="view-single-post.php?id='.$row['id'].' ">'.$row['post_title'].'</a></td>
            <td>'.$row['description'].'</td>
            <td><button type="submit" name="delete_post" value="'.$row['id'].'">Delete</button>
            </td>
        </tr>
        ';

        }

        ?>
        </tbody>

    </table>
    </form>
</center>
</body>
</html>