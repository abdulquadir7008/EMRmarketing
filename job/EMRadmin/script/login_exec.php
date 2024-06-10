<?php
session_start();
ob_start();
include("../../config.php");
if (isset($_REQUEST['login_button'])) {
    $username = $_POST['username'];
    $password_1 = $_POST['password'];
    $password = hash('sha512', $password_1);

    if ($username != '' && $password != '') {
        $qry = "SELECT * FROM admin_login WHERE (username = '$username' OR email_address='$username') AND password='$password' AND status=1";
        $result = mysqli_query($link, $qry);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $member = mysqli_fetch_array($result);

                // Set session variables
                $_SESSION['admin_id'] = $member['admin_id'];
                $_SESSION['username'] = $member['username'];
                session_write_close();

                // Redirect to another page
                header("location: ../index.php");
                ob_end_flush();
                exit; // Important: Ensure that code execution stops after the header redirection
            } else {
                // Handle incorrect login
                $errmsg_arr = array();
                $errflag = false;
                $errmsg_arr[] = 'Incorrect username or incorrect password.';
                $errflag = true;
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                session_write_close();
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit; // Important: Ensure that code execution stops after the header redirection
            }
        } else {
            // Handle database query error
            header("location: ../index.php");
            ob_end_flush();
            exit; // Important: Ensure that code execution stops after the header redirection
        }
    } else {
        // Handle empty username or password
        $errmsg_arr = array();
        $errflag = false;
        $errmsg_arr[] = 'Please fill in username and password.';
        $errflag = true;
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit; // Important: Ensure that code execution stops after the header redirection
    }
} else {
    header("location: ../index.php");
    ob_end_flush();
    exit; // Important: Ensure that code execution stops after the header redirection
}

mysqli_close($link);
?>