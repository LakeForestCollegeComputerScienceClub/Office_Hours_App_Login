<?
require 'init.php'; // database connection, etc
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
lib::public_log_out();



?>
