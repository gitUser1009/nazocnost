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
  <title>CRUD - Korisnik</title>
</head>
<body>
    
  <a href="./terminTable.php" class="btn btn-dark mt-2 ms-2">Nazad</a>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <?php include('message.php'); ?>
        <div class="card">
          <div class="card-header">
						<div class="row d-flex">
            	<?php
								$termin_id = mysqli_real_escape_string($conn, $_GET['id']);
								$query = "select t.datum, t.vrijeme_pocetka, t.vrijeme_zavrsetka, t.naziv, k.naziv as 'kolegij_naziv'
								FROM termin t
								JOIN veza v ON v.id = t.predavac_id
								JOIN users u ON u.id = v.profesor_id
								JOIN kolegij k ON k.id = t.kolegij_id
								WHERE t.id = '$termin_id' ";
								$query_run = mysqli_query($conn, $query);
								if(mysqli_num_rows($query_run) > 0){
									foreach($query_run as $row){
										$datum = $row['datum'];
										$vrijeme_pocetka = $row['vrijeme_pocetka'];
										$vrijeme_zavrsetka = $row['vrijeme_zavrsetka'];
										$naziv = $row['naziv'];
										$kolegij_naziv = $row['kolegij_naziv'];

										echo "<div class='col-3'><h4>Datum: $datum</h4></div>";
										echo "<div class='col-6 text-center'><h4>$kolegij_naziv ($naziv)</h4></div>";
										echo "<div class='col-3'>";
										echo "<div class='row'>";
										echo "<div class='col d-flex justify-content-end'><h4>Vrijeme pocetka: $vrijeme_pocetka</h4></div>";
										echo "</div>";
										echo "<div class='row'>";
										echo "<div class='col d-flex justify-content-end'><h4>Vrijeme zavrsetka: $vrijeme_zavrsetka</h4></div>";
										echo "</div>";
										echo "</div>";
									}
								}
							?>
						</div>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Ime studenta</th>
                <th>index</th>
                <th>Vrijeme dolazka</th>
                <th>Vrijeme odlazka</th>
              </tr>
            </thead>
            <tbody>
              <?php
								$termin_id = mysqli_real_escape_string($conn, $_GET['id']);
                $query = "select u.full_name, u.indeks, p.vrijeme_dolazka, p.vrijeme_odlazka
								FROM prisutnost p
								JOIN vezastudent v ON v.id = p.student_id 
								JOIN users u ON u.id = v.student_id
								JOIN termin t on t.id = p.termin_id
								WHERE t.id = '$termin_id' ";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $row){
                    ?>
                    <tr>
                      <td><?= $row['full_name']; ?></td>
                      <td><?= $row['indeks']; ?></td>
                      <td><?= $row['vrijeme_dolazka']; ?></td>
                      <td><?= $row['vrijeme_odlazka']; ?></td>
                    </tr>
                  <?php
                  }
                }
                else{
                  echo "<h5>Nema studija u bazi!</h5>";
                }
              ?>
            </tbody>
           </table>
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