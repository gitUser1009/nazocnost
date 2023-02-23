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
  <title>Uređivanje korisnika</title>
</head>
<body>
  <div class="container mt-5">
    <?php include('message.php'); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Uređivanje korisnika 
              <a href="./userTable.php" class="btn btn-danger float-end">Nazad</a>
            </h4>
          </div>
          <div class="card-body">
            <?php
            if(isset($_GET['id'])){
              $user_id = mysqli_real_escape_string($conn, $_GET['id']);
              $query = " SELECT * FROM users WHERE id='$user_id' ";
              $query_run = mysqli_query($conn, $query);
              if(mysqli_num_rows($query_run) > 0){
                $user = mysqli_fetch_array($query_run);
                ?>
                <form action="userCode.php" method="POST">
                  <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                  <div class="mb-3">
                    <label>Korisnicko ime</label>
                    <input type="text" name="name" value="<?=$user['name'];?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>Ime i prezime</label>
                    <input type="text" name="full_name" value="<?=$user['full_name'];?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>Index studenta</label>
                    <input type="text" name="indeks" value="<?=$user['indeks'];?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>Sifra korisnika </label>
                    <input type="text" name="pass" value="" class="form-control" placeholder="Potrebno je unijeti ponovno staru ili novu sifru">
                  </div>
									<div class="mb-3">
										<label for="roleSelect" class="">Izaberi ulogu korisnika</label>
										<select class="form-select" id="roleSelect" name="role">
											<?php if($user['role'] == "admin") echo "<option selected value='admin'>Admin</option>";
												else echo "<option value='admin'>Admin</option>";
											?>
											<?php if($user['role'] == "professor") echo "<option selected value='professor'>Professor</option>";
												else echo "<option value='professor'>Professor</option>";
											?>
											<?php if($user['role'] == "student") echo "<option selected value='student'>Student</option>";
												else echo "<option value='student'>Student</option>";
											?>
          					</select>
  								</div>
                  <div class="mb-3">
                    <button type="submit" name="update_user" class="btn btn-primary">
                    	Update Student
                    </button>
                  </div>
                </form>
                <?php
              }
              else{
                  echo "<h4>Korisnik sa datim ID-om nije pronađen</h4>";
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