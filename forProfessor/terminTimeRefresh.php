<?php 
  session_start();
  include "../php/db_conn.php";
  if (isset($_SESSION['name']) && isset($_SESSION['id'])) {   ?>


<table class="table table-bordered table-striped">
<thead>
                <tr>
                  <th>Ime studenta</th>
                  <th>Index</th>
                  <th>Vrijeme Dolazka</th>
                  <th>Vrijeme Odlzka</th>
                </tr>
              </thead>
              <tbody>
              <?php
                if(isset($_GET['id'])){
                  $termin_id = mysqli_real_escape_string($conn, $_GET['id']);
                  $termin_id = substr($termin_id, strpos($termin_id, "=") + 1); 
                  $query = " select u.full_name, u.indeks, p.vrijeme_dolazka, p.vrijeme_odlazka
                  FROM prisutnost p
                  JOIN vezastudent v ON v.id = p.student_id 
                  JOIN users u ON u.id = v.student_id
                  JOIN termin t on t.id = p.termin_id
                  WHERE t.id = '$termin_id' ";
                  $query_run = mysqli_query($conn, $query);
                  if(mysqli_num_rows($query_run) > 0){
                    foreach($query_run as $prisutnost){
                      ?>
                        <tr>
                          <td><?= $prisutnost['full_name']; ?></td>
                          <td><?= $prisutnost['indeks']; ?></td>
                          <td><?= $prisutnost['vrijeme_dolazka']; ?></td>
                          <td><?= $prisutnost['vrijeme_odlazka']; ?></td>
                        </tr>
                      <?php
                    }
                  }
                  else{
                    echo "<h4>Nema studenata na terminu</h4>";
                  }
                }
              ?>
              </tbody>
							</table>


<?php }else{
	header("Location: ../index.php");
} ?>
