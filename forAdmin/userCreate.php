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
  <title>Dodavanje korisnika</title>
</head>
<body>

<div class="container mt-5">
	<?php include('message.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Dodavanje korisnika 
						<a href="./userTable.php" class="btn btn-danger float-end">Nazad</a>
					</h4>
				</div>
				<div class="card-body">
					<form action="userCode.php" method="POST">
						<div class="mb-3">
							<label>Korisnicko ime</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="mb-3">
							<label>Ime i prezime korisnika</label>
							<input type="text" name="full_name" class="form-control">
						</div>
						<div class="mb-3">
							<label>Index studenta</label>
							<input type="text" name="indeks" class="form-control">
						</div>
						<div class="mb-3">
							<label>Sifra korisnika</label>
							<input type="text" name="pass" class="form-control">
						</div>
						<div class="mb-3">
							<label for="roleSelect" class="">Izaberi ulogu korisnika</label>
							<select class="form-select" id="roleSelect" name="role">
            					<option selected value="admin">Admin</option>
            					<option value="professor">Professor</option>
            					<option value="student">Student</option>
          					</select>
  						</div>
						<div class="mb-3">
							<button type="submit" name="save_user" class="btn btn-primary">Kreirak korisnika</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
    

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php }else{
	header("Location: ../index.php");
} ?>