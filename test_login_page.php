<?
require 'init.php'; // database connection, etc
require 'faculty_verify.php';
/*
Example for security
require 'admin_sec.php'; // database connection, etc

if ( ! admin_sec::verify_logged_on_state() ) {
   header("Location: login_page.php?expired=1");
   exit;
}
*/

// Additional PHP application logic goes here

// The actual web page (script output) starts with requiring the common header




?>
<? require_once './faculty_header.php'; ?>

Hello World!
<br />
<?=$fac_id?>
<?=$fac_email?>
<br />
<a href="public_log_out.php">Log Out</a>
<br /><br />
<?=strtotime('2015-08-01')?>
<? require_once './faculty_footer.php'; ?>
