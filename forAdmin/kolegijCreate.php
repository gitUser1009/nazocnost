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

<div class="container mt-5">
	<?php include('message.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Dodavanje kolegija 
						<a href="./kolegijTable.php" class="btn btn-danger float-end">Nazad</a>
					</h4>
				</div>
				<div class="card-body">
					<form action="kolegijCode.php" method="POST">
						<div class="mb-3">
							<label>Naziv kolegija</label>
							<input type="text" name="naziv" class="form-control">
						</div>
						<div class="mb-3">
							<label>Naziv studija</label>
							<input type="text" name="" class="form-control" id="studijTextNaziv" readonly>
						</div>
						<div class="mb-3">
							<label>ID studija</label>
							<input type="text" name="studij_id" class="form-control" id="studijTextId" readonly>
						</div>
						<div class="mb-3">
							<button type="submit" name="save_kolegij" class="btn btn-primary">Kreiraj kolegij</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
      <?php include('message.php'); ?>
        <div class="card">
          <div class="card-header">
            <h4>
              Izaberi studij kolegija
            </h4>
          </div>
          <div class="card-body">
					<table class="table table-bordered table-striped" id="tablicaStudiji">
            <thead>
              <tr>
                <th>ID</th>
                <th>Naziv studija</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $query = "select id as 'studij_id', naziv as 'studij_naziv' from studij";
              $query_run = mysqli_query($conn, $query);
              if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $studij){
                ?>
                  <tr>
                    <td><?= $studij['studij_id']; ?></td>
                    <td><?= $studij['studij_naziv']; ?></td>
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
  var table = document.getElementById('tablicaStudiji');

  for(var i = 1; i < table.rows.length; i++){
  	table.rows[i].onclick = function(){
    	//rIndex = this.rowIndex;
  		document.getElementById("studijTextId").value = this.cells[0].innerHTML;
    	document.getElementById("studijTextNaziv").value = this.cells[1].innerHTML;
  	};
	}

</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>








<?php }else{
	header("Location: ../index.php");
} ?>