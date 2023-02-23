
<?php 
  session_start();
  include "../php/db_conn.php";
  if (isset($_SESSION['name']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Admin</title>
</head>
<body>

<h1>ADMIN</h1>
  <h5>
	  <?=$_SESSION['full_name']?>
  </h5>
  <a href="../php/logout.php" class="btn btn-dark">Logout</a>
  <a href="./userTable.php" class="btn btn-primary">CRUD korisnici</a>
  <a href="./studijTable.php" class="btn btn-primary">CRUD studij</a>
  <a href="./kolegijTable.php" class="btn btn-primary">CRUD kolegij</a>
  <a href="./vezaTable.php" class="btn btn-primary">CRUD Povezivanje korisnika sa kolegijima</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php }else{
	header("Location: ../index.php");
} ?>