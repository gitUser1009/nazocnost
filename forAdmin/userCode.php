<?php
session_start();
require '../php/db_conn.php';

if(isset($_POST['save_user'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $indeks = mysqli_real_escape_string($conn, $_POST['indeks']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $pass = md5($pass);

    if(empty($indeks)){
        $query = "INSERT INTO users (name,full_name,indeks,pass,role) VALUES ('$name','$full_name',null,'$pass','$role')";
    }else{
        $query = "INSERT INTO users (name,full_name,indeks,pass,role) VALUES ('$name','$full_name','$indeks','$pass','$role')";
    }
    
    $query_run = mysqli_query($conn, $query);
    if($query_run){
        $_SESSION['message'] = "User Created Successfully";
        header("Location: userCreate.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Student Not Created";
        header("Location: userCreate.php");
        exit(0);
    }
}


if(isset($_POST['update_user'])){
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $indeks = mysqli_real_escape_string($conn, $_POST['indeks']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    if(!empty($pass)){
        $pass = md5($pass);
    }

    if(empty($indeks)){
        $query = "UPDATE users SET name='$name', full_name='$full_name', indeks=null, pass='$pass', role='$role' WHERE id='$user_id' ";
    }else{
        $query = "UPDATE users SET name='$name', full_name='$full_name', indeks='$indeks', pass='$pass', role='$role' WHERE id='$user_id' ";
    }

    if(!empty($name) && !empty($full_name) && !empty($role) && !empty($pass)){
        $query_run = mysqli_query($conn, $query);
    }
    
    if($query_run){
        $_SESSION['message'] = "User Updated Successfully";
        header("Location: userEdit.php?id=$user_id");
        exit(0);
    }
    else{
        $_SESSION['message'] = "User Not Updated";
        header("Location: userEdit.php?id=$user_id");
        exit(0);
    }
}


if(isset($_POST['delete_user'])){
    $user_id = mysqli_real_escape_string($conn, $_POST['delete_user']);

    $query = "DELETE FROM users WHERE id='$user_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Korisnik obrisan";
        header("Location: userTable.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Korisnik nije obrisan";
        header("Location: userTable.php");
        exit(0);
    }
}