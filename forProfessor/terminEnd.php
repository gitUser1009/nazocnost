<?php
session_start();
require '../php/db_conn.php';


if(isset($_POST['endTheTermin'])){
    $user_id = mysqli_real_escape_string($conn, $_SESSION['id']);
    $termin_id = mysqli_real_escape_string($conn, $_POST['endTheTermin']);

    echo $termin_id;
    $currentTime = date("h:i:sa");

    $query = "update termin SET vrijeme_zavrsetka='$currentTime', zavrsen='DA' WHERE id='$termin_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Termin završen";
        header("Location: terminTable.php?id=$user_id");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Termin se nije uspješno završio";
        header("Location: terminTable.php?id=$user_id");
        exit(0);
    }
}


if(isset($_POST['startTheTermin'])){
    foreach ($_POST as $key => $value) {

        echo $key;
        echo " = ";
        echo $value;
        echo "<br>";
    }

    $termin_naziv = mysqli_real_escape_string($conn, $_POST['termin_naziv']);
    $kolegij_id = mysqli_real_escape_string($conn, $_POST['kolegij_id']);
    $profesor_id = mysqli_real_escape_string($conn, $_POST['profesor_id']);
    $profesor_id = preg_replace("/[^0-9]/","",$profesor_id);
    $currentDate = date("Y/m/d");
    $currentTime = date("h:i:sa");

    $query = "select id FROM veza WHERE profesor_id = '$profesor_id' AND kolegij_id = '$kolegij_id' ";
    $query_run = mysqli_query($conn, $query);
    if($query_run){
        foreach($query_run as $row){
            $veza_id = $row['id'];
        }
    }

    $query = "insert INTO termin (naziv,predavac_id,kolegij_id,datum,vrijeme_pocetka, vrijeme_zavrsetka, zavrsen) 
    VALUES ('$termin_naziv','$veza_id','$kolegij_id','$currentDate','$currentTime', '00:00:00', 'NE')";

    $query_run = mysqli_query($conn, $query);
    if($query_run){
        $_SESSION['message'] = "Termin uspješno pokrenut";
        header("Location: terminTable.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "$query";
        header("Location: terminTable.php");
        exit(0);
    }

}