<?php require('include/config.php');

$db_query = new db_connect();

?>
<!DOCTYPE>
<html>
<head>
    
<title>VeerDict Blog</title>

</head>
<body>
<center>
<h5>ADMIN FUNCTIONS:</h5>
    <a href="add-new-post.php">Add new post</a><br/>
    <a href="view-post.php">View All post</a>
</center>
<?php 
    
echo DATE('Y-m-d H:i');    

   $get_post = "SELECT * FROM `post`";
    $run_get = mysqli_query($db_query->connection_start(),$get_post);
    while($rows= mysqli_fetch_assoc($run_get)) {
    
?>
    <hr>
    <h2><?php echo $rows['post_title'];?></h2>
    <h5>ADDed when: <?php echo $rows['time_added'];?></h5>
    <h4><?php echo $rows['description'];?></h4>
    <a href="<?php echo  'Single-post.php?id='.$rows['id'].' '?>">Read More-></a>
    <?php }?>
</body>


</html>