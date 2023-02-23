<?php
session_start();
require '../php/db_conn.php';


if(isset($_POST['find_user'])){
    $kolegij_id = mysqli_real_escape_string($conn, $_POST['kolegij_id']);
    $kolegij_naziv = mysqli_real_escape_string($conn, $_POST['kolegij_naziv']);
    $studij_naziv = mysqli_real_escape_string($conn, $_POST['studij_naziv']);

    if(!empty($kolegij_id)){
        $query = "SELECT k.id as 'kolegij_id', k.naziv as 'kolegij_naziv', s.naziv as 'studij_naziv' 
        FROM kolegij k
        JOIN studij s ON k.studij_id = s.id";
        $query_run = mysqli_query($conn, $query);
    }
    
    if($query_run){
        $_SESSION['message'] = "Odaberite korisnika za kolegij";
        header("Location: vezaCreateUser.php?id=$kolegij_id");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Morate odabrati kolegij";
        header("Location: vezaCreate.php");
        exit(0);
    }
}



if(isset($_POST['save_veza'])){
    $kolegij_id = mysqli_real_escape_string($conn, $_POST['kolegij_id']);
    $profesor_id = mysqli_real_escape_string($conn, $_POST['profesor_id']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);

    if(!empty($profesor_id)){
        $query = "INSERT INTO veza (kolegij_id, profesor_id) VALUES ('$kolegij_id', '$profesor_id')";
        $query_run = mysqli_query($conn, $query);
    }
    else if(!empty($student_id)){
        $query = "INSERT INTO vezastudent (kolegij_id, student_id) VALUES ('$kolegij_id', '$student_id')";
        $query_run = mysqli_query($conn, $query);
    }
    
    if($query_run){
        $_SESSION['message'] = "Povezivanje je bilo uspjesno";
        header("Location: vezaCreate.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Povezivanje nije bilo uspješno";
        header("Location: vezaCreate.php");
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




if(isset($_POST['delete_veza'])){
    $veza_id = mysqli_real_escape_string($conn, $_POST['delete_veza']);

    $query = "DELETE FROM veza WHERE id='$veza_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Veza obrisana";
        header("Location: vezaTable.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Veza nije obrisana";
        header("Location: vezaTable.php");
        exit(0);
    }
}


if(isset($_POST['delete_veza_student'])){
    $veza_id = mysqli_real_escape_string($conn, $_POST['delete_veza_student']);

    $query = "DELETE FROM vezastudent WHERE id='$veza_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Veza obrisana";
        header("Location: vezaTable.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Veza nije obrisana";
        header("Location: vezaTable.php");
        exit(0);
    }
}