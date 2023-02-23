<?php
session_start();
require '../php/db_conn.php';

$info = mysqli_real_escape_string($conn, $_GET['info']);


$delimiter = ' ';
$words = explode($delimiter, $info);
$student_id = $words[0];
$termin_id = $words[1];
$exitOrEnter = $words[2];
$randHash = $words[3];

echo $termin_id;
echo "<br>";
echo $student_id;


if($exitOrEnter == "ulaz"){
	$query = " select p.vrijeme_dolazka, p.vrijeme_odlazka
  FROM prisutnost p
  JOIN vezastudent v ON v.id = p.student_id 
  JOIN users u ON u.id = v.student_id
  JOIN termin t ON t.id = p.termin_id
  WHERE t.id = '$termin_id' AND u.id = '$student_id' ";
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0){
		echo "IZLAZ - Vec prijavljen";
		$_SESSION['message'] = "Već ste prijavljeni na ovo predavanje";
		header("Location: home.php");
		exit(0);
	}else{
		echo "Dobar prvi uvjet";
	}

	$query = " select t.kolegij_id
	FROM termin t
	WHERE t.id = '$termin_id' ";
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0){
		foreach($query_run as $row){
			$kolegij_id = $row['kolegij_id'];
		}
	}

	$query = " select * from vezastudent
	WHERE student_id = '$student_id' AND kolegij_id = '$kolegij_id' ";
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0){
		foreach($query_run as $row) $veza_id = $row['id'];
		$currentTime = date("h:i:sa");
		$query = "insert INTO prisutnost (termin_id,student_id,vrijeme_dolazka,vrijeme_odlazka) VALUES ('$termin_id','$veza_id','$currentTime','00:00:00')";
		$query_run = mysqli_query($conn, $query);
		if($query_run){
			$_SESSION['message'] = "Uspjesna prijava na termin";
			header("Location: home.php");
			exit(0);
		}
		else{
			$_SESSION['message'] = "Probajte ponovno";
			header("Location: home.php");
			exit(0);
		}
	}
	else{
		$_SESSION['message'] = "Ne pripadate ovom kolegiju";
		header("Location: home.php");
		exit(0);
	}
}


else if($exitOrEnter == "izlaz"){
	$query = " select p.vrijeme_dolazka, p.vrijeme_odlazka
  FROM prisutnost p
  JOIN vezastudent v ON v.id = p.student_id 
  JOIN users u ON u.id = v.student_id
  JOIN termin t ON t.id = p.termin_id
  WHERE t.id = '$termin_id' AND u.id = '$student_id' ";
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) == 0){
		$_SESSION['message'] = "Morate se prvo prijaviti na ovo predavanje";
		header("Location: home.php");
		exit(0);
	}



	$query = " select p.id, vrijeme_odlazka
	FROM prisutnost p
	JOIN termin t ON t.id = p.termin_id
	JOIN vezastudent v ON v.id = p.student_id
	JOIN users u ON u.id = v.student_id
	WHERE t.id = '$termin_id' AND u.id = '$student_id' AND p.vrijeme_odlazka = '00:00:00' ";
	$query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) > 0){
		foreach($query_run as $row) $prisutnost_id = $row['id'];
		$currentTime = date("h:i:sa");
		$query = "update prisutnost SET vrijeme_odlazka = '$currentTime' WHERE id = '$prisutnost_id' ";
		$query_run = mysqli_query($conn, $query);
		if($query_run){
			$_SESSION['message'] = "Uspjesna odjava sa termina";
			header("Location: home.php");
			exit(0);
		}
	}else{
		$_SESSION['message'] = "Probajte ponovno";
		header("Location: home.php");
		exit(0);
	}
}