<?php require('include/config.php');

$id = $_GET['id'];


$get_post = "SELECT * FROM `post` WHERE id='".$id."'";
$db_query = new db_connect();
$run_get = mysqli_query($db_query->connection_start(),$get_post);
$rows = mysqli_fetch_assoc($run_get);

$post_query = new post_query();

?>

<!DOCTYPE>
<html>
<head>
    <title><?php echo $rows['post_title'];?> | VeerDict </title>
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58dbb3c73dec30001259e6cf&product=inline-share-buttons"></script>

</head>

<body>

<center>
    <h5>ADMIN FUNCTIONS:</h5>
    <a href="add-new-post.php">Add new post</a><br/>
    <a href="view-post.php">View All post</a>
    <br/>
    <?php
    if(isset($_POST['Update'])){
        extract($_POST);
        $post_query->update_post($post_title,$desc,$post_main,$post_id);
    }
    ?>
    <form method="post" action="">
    <h4>Title</h4>
    <input type="text" name="post_title" value="<?php echo $rows['post_title'];?>">
    <h4>Description</h4>
    <input type="text" name="desc" value="<?php echo $rows['description'];?>">
    <h4>Content</h4>
    <textarea cols="80" rows="10"  name="post_main"><?php echo $rows['post_main'];?></textarea>
    <br/>
        <input type="hidden" name="post_id" value="<?php echo $id; ?>">
    <input type="submit" name="Update" value="Update">
    </form>
</center>


</body>
</html>