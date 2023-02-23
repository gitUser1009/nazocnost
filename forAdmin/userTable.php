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
              Korisnici
              <a href="./userCreate.php" class="btn btn-primary float-end">Dodaj Korisnika</a>
            </h4>
          </div>
          <div class="card-body">
           <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Korisnicko ime</th>
                <th>Ime i prezime</th>
                <th>Index</th>
                <th>Uloga</th>
                <th>CRUD</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = "SELECT * FROM users";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $user){
                    ?>
                    <tr>
                      <td><?= $user['id']; ?></td>
                      <td><?= $user['name']; ?></td>
                      <td><?= $user['full_name']; ?></td>
                      <td><?= $user['indeks']; ?></td>
                      <td><?= $user['role']; ?></td>
                      <td>
                        <a href="userEdit.php?id=<?= $user['id']; ?>" class="btn btn-success btn-sm">Uredi</a>
                        <form action="userCode.php" method="POST" class="d-inline">
                          <button type="submit" name="delete_user" value="<?=$user['id'];?>" class="btn btn-danger btn-sm">Obriši</button>
                        </form>
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