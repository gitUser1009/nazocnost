<?php
session_start();
require '../php/db_conn.php';

if(isset($_POST['save_kolegij'])){
    $naziv = mysqli_real_escape_string($conn, $_POST['naziv']);
    $studij_id = mysqli_real_escape_string($conn, $_POST['studij_id']);

    if(!empty($naziv)){
        $query = "INSERT INTO kolegij (naziv, studij_id) VALUES ('$naziv', '$studij_id')";
        $query_run = mysqli_query($conn, $query);
    }
    
    if($query_run){
        $_SESSION['message'] = "kolegij kreiran";
        header("Location: kolegijCreate.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "kolegij nije kreiran";
        header("Location: kolegijCreate.php");
        exit(0);
    }
}


if(isset($_POST['update_kolegij'])){
    $kolegij_id = mysqli_real_escape_string($conn, $_POST['id']);
    $naziv = mysqli_real_escape_string($conn, $_POST['naziv']);
    $studij_id = mysqli_real_escape_string($conn, $_POST['studij_id']);

    if(!empty($naziv)){
        $query = "UPDATE kolegij SET naziv='$naziv', studij_id='$studij_id' WHERE id='$kolegij_id' ";
        $query_run = mysqli_query($conn, $query);
    }
    
    if($query_run){
        $_SESSION['message'] = "kolegij uređen";
        header("Location: kolegijEdit.php?id=$kolegij_id");
        exit(0);
    }
    else{
        $_SESSION['message'] = "kolegij nije uređen";
        header("Location: kolegijEdit.php?id=$kolegij_id");
        exit(0);
    }
}




if(isset($_POST['delete_kolegij'])){
    $kolegij_id = mysqli_real_escape_string($conn, $_POST['delete_kolegij']);

    $query = "DELETE FROM kolegij WHERE id='$kolegij_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "kolegij obrisan";
        header("Location: kolegijTable.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "kolegij nije obrisan";
        header("Location: kolegijTable.php");
        exit(0);
    }
}