<?
require_once 'init.php';

function verify_logged_on_state(){
    if(isset($_COOKIE["login_cookie"])) {
        $user_token = $_COOKIE['login_cookie'];
        $query = "SELECT * FROM  office_fsess";
        $result = mysql_query($query);
        $num_rows = mysql_num_rows($result);
        if($num_rows>0){
            while ( $row = mysql_fetch_assoc($result)){
                $db_token = $row['fsess_logintoken'];
                if($user_token == $db_token) {
                    return true;
                }

            }
        }
        else
            return false;


    }
    else{
        return false;
    }

}

function get_fac_id(){
    if(isset($_COOKIE["login_cookie"])) {
        $user_token = $_COOKIE['login_cookie'];
        $query = "SELECT * FROM  office_fsess";
        $result = mysql_query($query);
        $num_rows = mysql_num_rows($result);
        if($num_rows>0){
            while ( $row = mysql_fetch_assoc($result)){
                $db_token = $row['fsess_logintoken'];
                if($user_token == $db_token) {
                    return $row['fsess_fac_id'];
                }

            }
        }

}

}

function get_fac_email(){
    $id = get_fac_id();
    $query = "SELECT fac_email FROM  office_fac_prof_table WHERE fac_id = '$id'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    return $row['fac_email'];

}

if( ! verify_logged_on_state()) {
    lib::public_log_out();
    header("Location: public_login.php?logged=true");
    exit;
    // echo "Cookie is not set";
}
else if(verify_logged_on_state()){
    $fac_id = get_fac_id();
    $fac_email = get_fac_email();
}
?>