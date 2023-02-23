<?php 
  session_start();
  include "../php/db_conn.php";
  if (isset($_SESSION['name']) && isset($_SESSION['id'])) {   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Profesor</title>
</head>
<body>
    
  <a href="./home.php" class="btn btn-dark mt-2 ms-2">Nazad</a>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-11">
      <?php include('message.php'); ?>
        <div class="card">
          <div class="card-header">
            <h4>
              Termini
              <a href="./terminStart.php" class="btn btn-primary float-end">Pokreni termin</a>
            </h4>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Ime predavaca</th>
                <th>Index predavaca</th>
                <th>Kolegij</th>
                <th>Studij</th>
                <th>Datum</th>
                <th>Vrijeme pocetka</th>
                <th>Vrijeme zavrsetka</th>
                <th>Termin zavrsen</th>
                <th>CRUD</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //IZMJENIT QUERY
                $profesor_id = mysqli_real_escape_string($conn, $_SESSION['id']);
                $profesor_id = preg_replace("/[^0-9]/","",$profesor_id);
                $query = "select t.id, k.naziv as 'kolegij_naziv', s.naziv as 'studij_naziv', u.full_name as 'profesor_ime', u.indeks as 'profesor_index', k.id as 'kolegij_id', u.id as 'profesor_id',
                t.datum ,t.vrijeme_pocetka, t.vrijeme_zavrsetka, t.zavrsen, t.naziv
                FROM termin t
                JOIN kolegij k ON k.id = t.kolegij_id
                JOIN studij s ON s.id = k.studij_id
                JOIN veza v ON v.id = t.predavac_id
                JOIN users u ON u.id = v.profesor_id
                where u.id = '$profesor_id' ";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $termin){
                    ?>
                      <tr>
                        <td><?= $termin['id']; ?></td>
                        <td><?= $termin['naziv']; ?></td>
                        <td><?= $termin['profesor_ime']; ?></td>
                        <td><?= $termin['profesor_index']; ?></td>
                        <td><?= $termin['kolegij_naziv']; ?></td>
                        <td><?= $termin['studij_naziv']; ?></td>
                        <td><?= $termin['datum']; ?></td>
                        <td><?= $termin['vrijeme_pocetka']; ?></td>
                        <td><?= $termin['vrijeme_zavrsetka']; ?></td>
                        <td><?= $termin['zavrsen']; ?></td>
                        <td>
                          <a href="termin<?php if($termin['zavrsen'] == "NE") echo "Time"; else echo "View" ?>.php?id=<?= $termin['id']; ?>" class="btn btn-<?php if($termin['zavrsen'] == "NE") echo "primary"; else echo "success" ?> btn-sm"><?php 
                            if($termin['zavrsen'] == "NE") echo "Nastavi termin";
                            else echo "Detalji termina";
                          ?></a>
                        </td>
                      </tr>
                    <?php
                  }
                }
                else{
                  echo "<h5>Nema korisnika u bazi!</h5>";
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