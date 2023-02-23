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
  <title>Profesor</title>
</head>
<body onload = "table();">
  <div class="container-fluid mt-3">
    <?php include('message.php'); ?>
    <div class="row">
      <?php 
        $termin_id = mysqli_real_escape_string($conn, $_GET['id']);
          $query = " select u.full_name, t.datum, t.naziv as 'termin_naziv', k.naziv as 'kolegij_naziv'
          FROM termin t
          JOIN veza v ON v.id = t.predavac_id
          JOIN users u ON u.id = v.profesor_id
          JOIN kolegij k ON k.id = t.kolegij_id
          where t.id = '$termin_id' ";
          $query_run = mysqli_query($conn, $query);
          if(mysqli_num_rows($query_run) > 0){
            foreach($query_run as $termin_info){
              $profesor_info = $termin_info['full_name'];
              $datum_info = $termin_info['datum'];
              $termin_naziv = $termin_info['termin_naziv'];
              $kolegij_naziv = $termin_info['kolegij_naziv'];
              echo "
                <div class='col-1'>
                  <a href='./terminTable.php' class='btn btn-danger'>Nazad</a>
                  <form action='terminEnd.php' method='POST' class='d-inline'>
                    <button type='submit' name='endTheTermin' value='$termin_id'; class='btn btn-danger btn-sm'>Završi</button>
                  </form>
                </div>
                <div class='col d-flex justify-content-center-start'>
                  <h2>$kolegij_naziv ($termin_naziv)</h2>
                </div>
                <div class='col d-flex justify-content-center'>
                  <h2>Predavac: $profesor_info</h2>
                </div>
                <div class='col d-flex justify-content-end'>
                  <h2>Datum: $datum_info</h2>
                </div>
              ";
            }
          }
      ?>
    </div>
    <hr>
    <div class="row">
      <!-- QR Kodovi -->
      <div class="col-md-6">
        <div class="row">
          <div class="col d-flex justify-content-center">
            <h2>Ulaz</h2>
          </div>
        </div>
        <div class="row">
          <div class="col d-flex justify-content-center">
            <?php
              $randNumber = rand(1, 5000000);
              $randNumber = (string)(md5($randNumber));
              echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$termin_id+ulaz+$randNumber&choe=UTF-8' alt=''>"
             ?>
          </div>
        </div>
        <hr class="mb-3">
        <div class="row">
          <div class="col d-flex justify-content-center">
            <h2>Izlaz</h2>
          </div>
        </div>
        <div class="row">
          <div class="col d-flex justify-content-center">
            <?php
              $randNumber = rand(1, 5000000);
              $randNumber = (string)(md5($randNumber));
              echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$termin_id+izlaz+$randNumber&choe=UTF-8' alt=''>"
             ?>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>
              Lista studenata na terminu
            </h4>
          </div>
          <div class="card-body">
          <script type="text/javascript">
              var url  = document.URL;
              var id = url.substring(url.lastIndexOf('/') + 1);
              // var id = id.substring(id.indexOf("=") + 1);
            function table(){
              const xhttp = new XMLHttpRequest();
              xhttp.onload = function(){
                document.getElementById("table").innerHTML = this.responseText;
              }
              xhttp.open("GET", "terminTimeRefresh.php?id="+id);
              xhttp.send();
            }
          
            setInterval(function(){
              table();
            }, 1000);
          </script>
          <div id="table" class="table table-bordered table-striped">

          </div>
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