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
  <title>Uređivanje studija</title>
</head>
<body>
  <div class="container mt-5">
    <?php include('message.php'); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Uređivanje studija 
              <a href="./studijTable.php" class="btn btn-danger float-end">Nazad</a>
            </h4>
          </div>
          <div class="card-body">
            <?php
            if(isset($_GET['id'])){
              $studij_id = mysqli_real_escape_string($conn, $_GET['id']);
              $query = " SELECT * FROM studij WHERE id='$studij_id' ";
              $query_run = mysqli_query($conn, $query);
              if(mysqli_num_rows($query_run) > 0){
                $studij = mysqli_fetch_array($query_run);
                ?>
                <form action="studijCode.php" method="POST">
                  <input type="hidden" name="studij_id" value="<?= $studij['id']; ?>">
                  <div class="mb-3">
                    <label>Naziv studija</label>
                    <input type="text" name="naziv" value="<?=$studij['naziv'];?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <button type="submit" name="update_studij" class="btn btn-primary">
                    	Uredi studij
                    </button>
                  </div>
                </form>
                <?php
              }
              else{
                  echo "<h4>Studij sa datim ID-om nije pronađen</h4>";
              }
            }
            ?>
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