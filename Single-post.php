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
    <a href="index.php">Home</a>
 <?php

if(isset($_POST['submit'])) {
    extract($_POST);
    $post_query->addcomment($commentor, $email, $comment,$post_id );
}
    
?>
    
    <h1><?php echo $rows['post_title'];?></h1>
    <h4>Added:<?php echo $rows['time_added'];?> &nbsp; Comments:<?php echo $rows['comment'];?> &nbsp; by VeerDict</h4>
    <h3>
        <?php echo ($rows['post_main']);?></h3>
    <div class="sharethis-inline-share-buttons"></div>
    
    
    <?php 
    
    $select_comment = "SELECT * FROM `comment` WHERE `post_id`='".$id."' ";
    $run_select = mysqli_query($db_query->connection_start(),$select_comment);
   
    $count = mysqli_num_rows($run_select);
    if($count=='0'){
        echo "No comment Availabe <br/>";
    }else{
             echo $rows['comment']; echo" Comment(s)";
      while($rows = mysqli_fetch_assoc($run_select)){
         $check_reply = $rows['id']; 
          ?>
    
    <h2><?php echo $rows['commentor']; ?></h2>
    <h4>    <?php echo $rows['comment_time']; ?> &nbsp; 
    
        
    <!-- For Replying msg -->    
    <form method="post" action="">
    <input type="hidden" name="reply_id" value="<?php echo $rows['id'];?>">

    <input type="submit" name="reply" value="Reply">    
    </form>
    </h4>
    
    <h3>    
        
        <?php echo $rows['comment'];echo"</h3>"; 
        
        $select_comment_reply = "SELECT * FROM `reply_comment` WHERE `reply_id`='".$check_reply."' ";
    $run_select_reply = mysqli_query($db_query->connection_start(),$select_comment_reply);
        $count = mysqli_num_rows($run_select_reply);
          $rows = mysqli_fetch_assoc($run_select_reply);
          $confirm_reply = $rows['reply_id'];
    if($count>='1'){
    if($confirm_reply == $check_reply) {   
     $select_comment_reply_th = "SELECT * FROM `reply_comment` WHERE `reply_id`='".$check_reply."' ";
        
        $run_select_reply_th = mysqli_query($db_query->connection_start(),$select_comment_reply_th);
         while($rows = mysqli_fetch_assoc($run_select_reply_th)){
        ?>
    
        <dl>
            <dd><h3><?php echo $rows['commentor']; ?></h3><h5><?php echo $rows['comment_time']; ?></h5>
                <h4><?php echo $rows['comment']; ?></h4>
            </dd>
        </dl>
    
        
    
    
    <?php } }} echo"<hr>";
              if(isset($_POST['reply'])){
            $reply_id=   $_POST['reply_id'];
         
                 if($check_reply == $reply_id) {
              
              
         
          ?>
       <form action="" method="post">
    <input name="reply_commentor" placeholder="Name"><br/>
    <h1></h1>
    <input type="email" name="reply_email" placeholder="email"><br/>
    <h1>
        <input type="hidden" name="post_id" value="<?php echo "$id "; ?>" >
        <input type="hidden" name="reply_id" value="<?php echo "$reply_id "; ?>" >
        </h1>
    <textarea cols="20px" name="reply_comment" placeholder="enter comment"></textarea> <br/>
        <input type="submit" name="replying_comment" value="Reply">
    </form>
    <hr>
    <?php
                 }}
            if(isset($_POST['replying_comment'])){
                  extract($_POST);
                  $post_query->replycomment($reply_commentor, $reply_email, $reply_comment,$post_id,$reply_id );
}
    ?>
    
    <?php
      } 
        
    }
    ?>
    
    
    <!-- Comment Form -->
    Place comment Below:<br/>
    <form action="" method="post">
    <input name="commentor" placeholder="Name"><br/>
    <h1></h1>
    <input type="email" name="email" placeholder="email"><br/>
    <h1>
        <input type="hidden" name="post_id" value="<?php echo "$id "; ?>" >
        </h1>
    <textarea cols="20px" name="comment" placeholder="enter comment"></textarea> <br/>
        <input type="submit" name="submit">
    </form>
    
</body>    

</html>