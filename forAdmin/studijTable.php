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
  <title>CRUD - Korisnik</title>
</head>
<body>
    
  <a href="./home.php" class="btn btn-dark mt-2 ms-2">Nazad</a>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <?php include('message.php'); ?>
        <div class="card">
          <div class="card-header">
            <h4>
              Studiji
              <a href="./studijCreate.php" class="btn btn-primary float-end">Dodaj studij</a>
            </h4>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Naziv studija</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = "SELECT * FROM studij";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $studij){
                    ?>
                    <tr>
                      <td><?= $studij['id']; ?></td>
                      <td><?= $studij['naziv']; ?></td>
                      <td>
                        <a href="studijEdit.php?id=<?= $studij['id']; ?>" class="btn btn-success btn-sm">Uredi</a>
                        <form action="studijCode.php" method="POST" class="d-inline">
                          <button type="submit" name="delete_studij" value="<?=$studij['id'];?>" class="btn btn-danger btn-sm">Obriši</button>
                        </form>
                      </td>
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