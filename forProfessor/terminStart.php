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
<body>

<div class="container mt-5 ">
	<?php include('message.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Povezivanje korisnika sa kolegijima 
						<a href="./terminTable.php" class="btn btn-danger float-end">Nazad</a>
					</h4>
				</div>
				<div class="card-body">
					<form action="terminEnd.php" method="POST">
					<div class="mb-3">
							<label>Naziv termina</label>
							<input type="text" name="termin_naziv" class="form-control" id="">
						</div>
            <div class="mb-3">
							<label>ID kolegija</label>
							<input type="text" name="kolegij_id" class="form-control" id="kolegij_id" readonly>
						</div>
            <div class="mb-3">
							<label>Naziv kolegija</label>
							<input type="text" name="kolegij_naziv" class="form-control" id="kolegij_naziv" readonly>
						</div>
            <div class="mb-3">
							<label>Naziv studija</label>
							<input type="text" name="studij_naziv" class="form-control" id="studij_naziv" readonly>
						</div>
						<div class="mb-3">
							<input type="hidden" id="profesor_id" name="profesor_id" value=<?= $_SESSION['id']; ?>">
						</div>
            <div class="mb-3">
							<button type="submit" name="startTheTermin" class="btn btn-primary">Pokreni termin</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="container mt-5">
    <div class="row">
      <div class="col">
      <?php include('message.php'); ?>
        <div class="card">
          <div class="card-header">
            <h4>
              Izaberi kolegij
            </h4>
          </div>
          <div class="card-body">
					<table class="table table-bordered table-striped" id="tablicaKolegiji">
            <thead>
              <tr>
                <th>ID</th>
                <th>Naziv kolegija</th>
                <th>Naziv studija</th>
              </tr>
            </thead>
            <tbody>
            <?php
							$profesor_id = $_SESSION['id'];
              $query = "select k.id as 'kolegij_id', k.naziv as 'nazivKolegija', s.naziv as 'nazivStudija', v.profesor_id
							FROM kolegij k
							JOIN studij s ON k.studij_id = s.id
							JOIN veza v ON v.kolegij_id = k.id
							WHERE v.profesor_id = '$profesor_id' ";
              $query_run = mysqli_query($conn, $query);
              if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $kolegij){
                ?>
                  <tr>
                    <td><?= $kolegij['kolegij_id']; ?></td>
                    <td><?= $kolegij['nazivKolegija']; ?></td>
                    <td><?= $kolegij['nazivStudija']; ?></td>
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

<script> 
  var table = document.getElementById('tablicaKolegiji');

  for(var i = 1; i < table.rows.length; i++){
  	table.rows[i].onclick = function(){
    	//rIndex = this.rowIndex;
  		document.getElementById("kolegij_id").value = this.cells[0].innerHTML;
    	document.getElementById("kolegij_naziv").value = this.cells[1].innerHTML;
    	document.getElementById("studij_naziv").value = this.cells[2].innerHTML;
  	};
	}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


<?php }else{
	header("Location: ../index.php");
} ?>