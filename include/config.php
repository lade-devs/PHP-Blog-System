<?php
define('db_host', 'localhost');
 define('db_user', 'root');
 define('db_pass', '');
 define('db_name', 'blog');

//error_reporting(0);


//$conn = mysqli_connect(db_host, db_user, db_pass, db_name);
// if (!$conn) {
//     die("<center><h4>Sorry, Unable to connect at Moment, Please try again later</h4>You can contact the Web Master: webmaster@v-intel_inc.co</center>");
// }


define('included', 1);
include('function.php');
include('post_query.php');


date_default_timezone_set('Africa/Lagos');
?>