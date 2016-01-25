<?
require 'init.php';
if(!isset($_COOKIE["login_cookie"])) {
    $login_token = lib::generateRandomString();
    $login_attempts = 0;
    setcookie("login_cookie", $login_token, time() + (3600 * 3), '/');
}
$get_post;

if(lib::ldap_login($get_post['username'],$get_post['password'])) {
    $email = $get_post['username'].'@mx.lakeforest.edu';
    $query = "SELECT * FROM  office_fac_prof_table";
    $result = mysql_query($query);
    $num_rows = mysql_num_rows($result);
    if($num_rows>0){
        while ( $row = mysql_fetch_assoc($result)){
            if($email == $row['fac_email']) {
                $fac_id = $row['fac_id'];
            }

        }
    }
    $task = $get_post['attempt'];
    $started = time();

    switch ($task) {
        case 'login':
            if(isset($_COOKIE["login_cookie"])) {
                $login_token = $_COOKIE['login_cookie'];
                $database = "".FACULTY_SESSION;
                $query = "INSERT INTO $database VALUES ('','$fac_id', '$started','','','$login_attempts','$login_token')"; //create a class to make the inserting and other things easier.
                $result = mysql_query($query);
                header("Location: test_login_page.php");
            }

        default:
    }
}
/*else{
    $login_attempts++;
    //$error_message = 'Incorrect Username and/or Password. Please try again';
    if($login_attempts >=6){
        $locked_out_message = 'You have failed to log on too many times. Please try again in 1 minutes';
        if(!isset($_COOKIE["locked_cookie"])) {
            setcookie("locked_cookie", 'You are locked out', time() + (60 * 1), '/');
        }
    }
    else
        $locked_out_message = '';
}*/
if($get_post['logged'] == 'true')
    $logged_out_message = 'You have been Logged out of the site. To continue, please log back in';
else
    $logged_out_message = '';
?>
<? require_once './faculty_header.php';
?>
<?=$logged_out_message?>
<?=$locked_out_message?>
<?=$error_message?>
<h1>Public Login</h1>
<form name="public_login" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return true" method="POST">
    <input type="hidden" name="attempt" value="login">
    <input type="hidden" name="logged" value="0">
    Username:
    <input type="text" name="username" value="" required>
    <br/><br/>
    Password:
    <input type="password" name="password" value="" required>
    <br/><br/>
    <input type="reset" value="Reset">
    <input type="submit" value="Submit"<? if(isset($_COOKIE['locked_cookie'])){?>disabled<?}?> >
</form>
<br/>
<a href="">Forget Password</a> or <a href="">Username</a>
<br/><br/>



<? require_once './faculty_footer.php'; ?>