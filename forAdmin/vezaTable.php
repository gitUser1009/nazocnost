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
  <title>CRUD - Povezivanje kolegija</title>
</head>
<body>
    
  <a href="./home.php" class="btn btn-dark mt-2 ms-2">Nazad</a>

  <div class="container-fluid mt-4">
    <div class="row">
    <?php include('message.php'); ?>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h4>
              Lista povezanih profesora
              <a href="./vezaCreate.php" class="btn btn-primary float-end">Novo povezivanje</a>
            </h4>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Naziv kolegija</th>
                <th>Naziv studija</th>
                <th>Ime profesora</th>
                <th>Index profesora</th>
                <th>CRUD</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //IZMJENIT QUERY
                $query = "select v.id, s.naziv as 'studij_naziv', k.naziv as 'kolegij_naziv',u.full_name as 'profesor_ime', u.indeks as 'profesor_index'
                FROM studij s
                JOIN kolegij k ON s.id = k.studij_id
                JOIN veza v ON k.id = v.kolegij_id
                JOIN users u ON v.profesor_id = u.id";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $veza){
                    ?>
                    <tr>
                      <td><?= $veza['id']; ?></td>
                      <td><?= $veza['studij_naziv']; ?></td>
                      <td><?= $veza['kolegij_naziv']; ?></td>
                      <td><?= $veza['profesor_ime']; ?></td>
                      <td><?= $veza['profesor_index']; ?></td>
                      <td>
                        <form action="vezaCode.php" method="POST" class="d-inline">
                          <button type="submit" name="delete_veza" value="<?=$veza['id'];?>" class="btn btn-danger btn-sm">Obriši</button>
                        </form>
                      </td>
                    </tr>
                  <?php
                  }
                }
                else{
                  echo "<h5>Nema povezanih profesora sa kolegijima!</h5>";
                }

              ?>
            </tbody>
           </table>
          </div>
      </div>
    </div>
    <div class="col-6">
      <?php include('message.php'); ?>
        <div class="card">
          <div class="card-header">
            <h4>
              Lista povezanih studenata
            </h4>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Naziv kolegija</th>
                <th>Naziv studija</th>
                <th>Ime studenta</th>
                <th>Index studenta</th>
                <th>CRUD</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //IZMJENIT QUERY
                $query = "select v.id, s.naziv as 'studij_naziv', k.naziv as 'kolegij_naziv',u.full_name as 'student_ime', u.indeks as 'student_index'
                FROM studij s
                JOIN kolegij k ON s.id = k.studij_id
                JOIN vezastudent v ON k.id = v.kolegij_id
                JOIN users u ON v.student_id = u.id";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $veza){
                    ?>
                    <tr>
                      <td><?= $veza['id']; ?></td>
                      <td><?= $veza['studij_naziv']; ?></td>
                      <td><?= $veza['kolegij_naziv']; ?></td>
                      <td><?= $veza['student_ime']; ?></td>
                      <td><?= $veza['student_index']; ?></td>
                      <td>
                        <form action="vezaCode.php" method="POST" class="d-inline">
                          <button type="submit" name="delete_veza_student" value="<?=$veza['id'];?>" class="btn btn-danger btn-sm">Obriši</button>
                        </form>
                      </td>
                    </tr>
                  <?php
                  }
                }
                else{
                  echo "<h5>Nema povezanih profesora sa kolegijima!</h5>";
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