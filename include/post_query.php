<?php
if (!defined('included')){
die('Sorry you cannot access this file directly!');
}
include ('db_connect.php');
class post_query extends db_connect
{

// Adding Blog Post
    function addpost($post_title,$desc,$post_main)
    {


        $post_title = strip_tags(mysqli_real_escape_string($this->connection_start(),$post_title));
        $post_main = strip_tags(mysqli_real_escape_string($this->connection_start(), $post_main));
        $desc = strip_tags(mysqli_real_escape_string($this->connection_start(), ($desc)));
        $time_added = date('Y-m-d H:i:s');

        $insert_post = "INSERT INTO `post`(`post_title`,`post_main`,`time_added`,`description`) VALUES( '" . $post_title . "','" . $post_main . "','" . $time_added . "','" . $desc . "') ";
        $run_insert = mysqli_query($this->conn, $insert_post);
        if (!$run_insert) {
            die("ERROR 101");
        } else {
            header('Location: index.php');
            exit();
        }
    }

// Adding Comment
    function addcomment($commentor, $email, $comment, $post_id){


        $commentor = strip_tags(mysqli_real_escape_string($this->connection_start(),$commentor));
        $email = strip_tags(mysqli_real_escape_string(($this->connection_start()), ($email)));
        $comment = strip_tags(mysqli_real_escape_string(($this->connection_start()), ($comment)));
        $post_id = strip_tags(mysqli_real_escape_string(($this->connection_start()), ($post_id)));

        $time_added = date('Y-m-d H:i:s');

        $insert_comment = "INSERT INTO `comment`(`commentor`,`email`,`comment`,`comment_time`,`post_id`) VALUES('" . $commentor . "','" . $email . "','" . $comment . "','" . $time_added . "','" . $post_id . "')";
        $run_insert = mysqli_query($this->connection_start(), $insert_comment);

        if (!$run_insert) {
            die("ERROR 102");
        } else {
            $select_post = "SELECT * FROM `post` WHERE id='" . $post_id . "' ";
            $run_select = mysqli_query($this->connection_start(), $select_post);
            $rows = mysqli_fetch_assoc($run_select);
            $comment = $rows['comment'];
            $add = '1';

            $final_comment = $comment + $add;
            $update_post = "UPDATE `post` SET `comment`='" . $final_comment . "' WHERE id='" . $post_id . "' ";
            $run_update = mysqli_query($this->connection_start(), $update_post);
            if (!$run_update) {
                die("ERROR 201");
            } else {
                header('Location: Single-post.php?id='. $post_id);
                exit();
            }
        }
    }

// Replying a Comment
    function replycomment($reply_commentor, $reply_email, $reply_comment, $post_id, $reply_id)
    {

        $reply_commentor = strip_tags(mysqli_real_escape_string(($this->connection_start()), ($reply_commentor)));
        $reply_email = strip_tags(mysqli_real_escape_string(($this->connection_start()), ($reply_email)));
        $reply_comment = strip_tags(mysqli_real_escape_string(($this->connection_start()), ($reply_comment)));
        $post_id = strip_tags(mysqli_real_escape_string(($this->connection_start()), ($post_id)));
        $reply_id = strip_tags(mysqli_real_escape_string(($this->connection_start()), ($reply_id)));

        $time_added = date('Y-m-d H:i:s');

        $insert_comment = "INSERT INTO `reply_comment`(`commentor`,`email`,`comment`,`comment_time`,`post_id`, `reply_id`) VALUES('" . $reply_commentor . "','" . $reply_email . "','" . $reply_comment . "','" . $time_added . "','" . $post_id . "','" . $reply_id . "')";
        $run_insert = mysqli_query($this->connection_start(), $insert_comment);

        if (!$run_insert) {
            die("ERROR 102");
        } else {
            $select_post = "SELECT * FROM `post` WHERE id='" . $post_id . "' ";
            $run_select = mysqli_query($this->connection_start(), $select_post);
            $rows = mysqli_fetch_assoc($run_select);
            $comment = $rows['comment'];
            $add = '1';

            $final_comment = $comment + $add;
            $update_post = "UPDATE `post` SET `comment`='" . $final_comment . "' WHERE id='" . $post_id . "' ";
            $run_update = mysqli_query($this->connection_start(), $update_post);
            if (!$run_update) {
                die("ERROR 201");
            } else {
                header('Location: Single-post.php?id='. $post_id);
                exit();
            }
        }
    }

    // DELETING POST
    function  delete_post($post_id){
        $post_id = strip_tags(mysqli_real_escape_string(($this->connection_start()), ($post_id)));

        $del_post = " DELETE FROM `post` WHERE `id`=$post_id  ";
         mysqli_query($this->connection_start(),$del_post);

        $del_comment = "DELETE FROM `comment` WHERE  `post_id`=$post_id ";
         mysqli_query($this->connection_start(),$del_comment);

        $del_reply_comment = "DELETE FROM `reply_comment` WHERE `post_id`=$post_id ";
        $run_reply = mysqli_query($this->connection_start(),$del_reply_comment);
        if(!$run_reply){die("error");}
        else {
            header('Location: view-post.php');
            exit();
        }
    }

    // UPDATING POST
    function update_post($post_title,$desc,$post_main,$post_id)
    {


        $post_title = strip_tags(mysqli_real_escape_string($this->connection_start(),$post_title));
        $post_main = strip_tags(mysqli_real_escape_string($this->connection_start(), $post_main));
        $desc = strip_tags(mysqli_real_escape_string($this->connection_start(), ($desc)));
        $post_id = strip_tags(mysqli_real_escape_string($this->connection_start(), ($post_id)));

        echo $post_title.$post_main.$desc.$post_id;

        $update_post = " UPDATE `post` SET `post_title`='$post_title',`post_main`='$post_main',`description`='$desc'  WHERE `id`='$post_id'   ";
        $run_insert = mysqli_query($this->connection_start(),$update_post);
        if (!$run_insert) {
            die("ERROR 101");
        } else {
            header('Location: view-single-post.php?id='.$post_id);
            exit();
        }
    }
}
?>