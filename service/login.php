<?php
    require 'dbcon.php';
    
    $cust_username = mysqli_real_escape_string($dbcon,$_POST['username']);
    $cust_password = mysqli_real_escape_string($dbcon,$_POST['password']);
    
    $salt = 'tikde78uj4ujuhlaoikiksakeidke';
    $hash_cust_password = hash_hmac('sha256', $cust_password, $salt);
    
    $sql = "SELECT * FROM customer WHERE cust_username=? AND cust_password=?";
    $stmt = mysqli_prepare($dbcon, $sql);
    mysqli_stmt_bind_param($stmt,"ss", $cust_username,$hash_cust_password);
    mysqli_execute($stmt);
    $result_user = mysqli_stmt_get_result($stmt);
    if ($result_user->num_rows == 1) {
        session_start();
        $row_user = mysqli_fetch_array($result_user,MYSQLI_ASSOC);
        $_SESSION['cust_id'] = $row_user['cust_id'];
        if ($remember == "yes") { 
            setcookie("cust_username", $cust_username, time()+60*60*24*30, "/"); //30 วัน
        }
        header("Location: index.php");
    } else {
        header("Location: error.php?code=1");
    }
    