<?php
session_start();
include "./db_conn.php";

if(isset($_POST['username']) && isset($_POST['password'])){
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
  
      $username = test_input($_POST['username']);
      $password = test_input($_POST['password']);
      $role = test_input($_POST['role']);

      if(empty($username)){
        header("Location: ../index.php?error=User name is Required");
      }else if(empty($password)){
        header("Location: ../index.php?error=Password is Required");
      }else{
        $password = md5($password);
        echo $password;
        $sql = "SELECT * FROM users WHERE name='$username' AND pass='$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if ($row['pass'] === $password && $row['role'] == $role){
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['full_name'] = $row['full_name'];
                $_SESSION['indeks'] = $row['indeks'];
                $_SESSION['role'] = $row['role'];

                if($role == "admin") header("Location: ../forAdmin/home.php");
                else if($role == "professor") header("Location: ../forProfessor/home.php");
                else if($role == "student") header("Location: ../forStudent/home.php");
                
            } else header("Location: ../index.php?error=Incorect User name or password");
        } else header("Location: ../index.php?error=Incorect User name or password");
    }

}else{
    header("Location: ../index.php");
}

?>