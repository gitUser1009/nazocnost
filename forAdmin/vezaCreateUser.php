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
  <title>Dodavanje kolegija</title>
</head>
<body>




<div class="container-fluid mt-5 ">
	<?php include('message.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Povezivanje korisnika sa kolegijima 
						<a href="./vezaCreate.php" class="btn btn-danger float-end">Nazad</a>
					</h4>
				</div>
				<div class="card-body">
          <?php
          $kolegij_id = mysqli_real_escape_string($conn, $_GET['id']);
          $query = "select k.id as 'kolegij_id', k.naziv as 'nazivKolegija', s.naziv as 'nazivStudija' 
          FROM kolegij k
          JOIN studij s ON k.studij_id = s.id
          WHERE k.id = '$kolegij_id'";
          $query_run = mysqli_query($conn, $query);
          if(mysqli_num_rows($query_run) > 0){
            $kolegij = mysqli_fetch_array($query_run);
          }
            ?>
					<form action="vezaCode.php" method="POST">
            <div class="row">
              <div class="col">
                <div class="mb-3">
							    <label>ID kolegija</label>
							    <input type="text" name="kolegij_id" value="<?= $kolegij['kolegij_id']; ?>" class="form-control" id="kolegij_id" readonly>
						    </div>
              </div>
              <div class="col">
                <div class="mb-3">
							    <label>ID Profesora</label>
							    <input type="text" name="profesor_id" id="profesor_id" class="form-control" id="" readonly>
						    </div>
              </div>
              <div class="col">
                <div class="mb-3">
							    <label>ID Studenta</label>
							    <input type="text" name="student_id" class="form-control" id="student_id" readonly>
						    </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-3">
							    <label>Naziv kolegija</label>
							    <input type="text" name="kolegij_ime" value="<?= $kolegij['nazivKolegija']; ?>" class="form-control" id="" readonly>
						    </div>
              </div>
              <div class="col">
                <div class="mb-3">
							    <label>Ime profesora</label>
							    <input type="text" name="profesor_ime" id="profesor_ime" class="form-control" id="" readonly>
						    </div>
              </div>
              <div class="col">
                <div class="mb-3">
							    <label>Ime studenta</label>
							    <input type="text" name="student_ime" class="form-control" id="student_ime" readonly>
						    </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <div class="mb-3">
							    <label>Naziv studija</label>
							    <input type="text" name="studij_ime" value="<?= $kolegij['nazivStudija']; ?>" class="form-control" id="" readonly>
						    </div>
              </div>
            </div>
            <div class="mb-3">
							<button type="submit" name="save_veza" class="btn btn-primary">Poveži korisnika</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="container-fluid mt-4">
    <div class="row">
      <div class="col-md-6">
      <?php include('message.php'); ?>
        <div class="card">
          <div class="card-header">
            <h4>
              Profesori
            </h4>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped" id="tablicaProfesori">
            <thead>
              <tr>
                <th>ID</th>
                <th>Ime i prezime</th>
                <th>Index</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = " SELECT * FROM users
                WHERE role='professor' AND id NOT IN 
                (SELECT profesor_id FROM veza WHERE veza.kolegij_id='$kolegij_id')";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $user){
                    ?>
                    <tr>
                      <td><?= $user['id']; ?></td>
                      <td><?= $user['full_name']; ?></td>
                      <td><?= $user['indeks']; ?></td>
                    </tr>
                  <?php
                  }
                }
                else{
                  echo "<h5>Nema slobodnih profesora u bazi!</h5>";
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
              Studenti
            </h4>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped" id="tablicaStudenti">
            <thead>
              <tr>
                <th>ID</th>
                <th>Ime i prezime</th>
                <th>Index</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = " SELECT * FROM users WHERE role='student' AND id NOT IN (
                  SELECT vezastudent.student_id FROM vezastudent WHERE vezastudent.kolegij_id='$kolegij_id');";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $user){
                    ?>
                    <tr>
                      <td><?= $user['id']; ?></td>
                      <td><?= $user['full_name']; ?></td>
                      <td><?= $user['indeks']; ?></td>
                    </tr>
                  <?php
                  }
                }
                else{
                  echo "<h5>Nema studenata profesora u bazi!</h5>";
                }

              ?>
            </tbody>
           </table>
          </div>
      </div>
    </div>
  </div> 
</div>

    








<script> 
  var table = document.getElementById('tablicaProfesori');

  for(var i = 1; i < table.rows.length; i++){
  	table.rows[i].onclick = function(){
    	//rIndex = this.rowIndex;
  		document.getElementById("profesor_id").value = this.cells[0].innerHTML;
    	document.getElementById("profesor_ime").value = this.cells[1].innerHTML;
      document.getElementById("student_id").value = null;
      document.getElementById("student_ime").value = null;
  	};
	}


  var table = document.getElementById('tablicaStudenti');

  for(var i = 1; i < table.rows.length; i++){
  	table.rows[i].onclick = function(){
    	//rIndex = this.rowIndex;
  		document.getElementById("student_id").value = this.cells[0].innerHTML;
    	document.getElementById("student_ime").value = this.cells[1].innerHTML;
      document.getElementById("profesor_id").value = null;
      document.getElementById("profesor_ime").value = null;
  	};
	}

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>








<?php }else{
	header("Location: ../index.php");
} ?>