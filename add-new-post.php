<?php require('include/config.php');

$query = new post_query();
?>

<!DOCTYPE>
<html>
<head>
    
<title>Add New Blog Post | VeerDict</title>
 <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  
</head>
<body>
<a href="index.php"><- Home</a>
<center>
    <h5>ADMIN FUNCTIONS:</h5>
    <a href="add-new-post.php">Add new post</a><br/>
    <a href="view-post.php">View All post</a>
</center>

    <?php

if(isset($_POST['submit'])) {
    extract($_POST);
    $query->addpost($post_title,$desc,$post_main);
}
?>
    <center>  <form method="post" action="">
    
    <h4>Title</h4>
    <input type="text" name="post_title">
    <h4>Description</h4>
        <input type="text" name="desc">
    <h4>Content</h4>    
<textarea cols="80" rows="10"  name="post_main"></textarea>
     <br/>
    <input type="submit" name="submit">
    </form>
    </center>
  

    
</body>


</html>