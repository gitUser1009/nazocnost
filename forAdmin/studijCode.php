<?php
session_start();
require '../php/db_conn.php';

if(isset($_POST['save_studij'])){
    $naziv = mysqli_real_escape_string($conn, $_POST['naziv']);

    if(!empty($naziv)){
        $query = "INSERT INTO studij (naziv) VALUES ('$naziv')";
        $query_run = mysqli_query($conn, $query);
    }
    
    if($query_run){
        $_SESSION['message'] = "studij kreiran";
        header("Location: studijCreate.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Studij nije kreiran";
        header("Location: studijCreate.php");
        exit(0);
    }
}


if(isset($_POST['update_studij'])){
    $studij_id = mysqli_real_escape_string($conn, $_POST['studij_id']);

    $naziv = mysqli_real_escape_string($conn, $_POST['naziv']);

    if(!empty($naziv)){
        $query = "UPDATE studij SET naziv='$naziv' WHERE id='$studij_id' ";
        $query_run = mysqli_query($conn, $query);
    }
    
    if($query_run){
        $_SESSION['message'] = "studij uređen";
        header("Location: studijEdit.php?id=$studij_id");
        exit(0);
    }
    else{
        $_SESSION['message'] = "studij nije uređen";
        header("Location: studijEdit.php?id=$studij_id");
        exit(0);
    }
}


if(isset($_POST['delete_studij'])){
    $studij_id = mysqli_real_escape_string($conn, $_POST['delete_studij']);

    $query = "DELETE FROM studij WHERE id='$studij_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Studij obrisan";
        header("Location: studijTable.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Studij nije obrisan";
        header("Location: studijTable.php");
        exit(0);
    }
}