<?php 
    include_once 'include/session.inc.php';
    include_once 'include/db.inc.php';
    include_once 'header/header.html'; 

    if(isset($_SESSION['username']) || isset($_SESSION['password'])) {
      header('Location: user.php');
    }

    if(isset($_POST['login-button'])) {
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      $stmt = $conn->prepare('SELECT * FROM users WHERE username=? AND password=?;');
      $stmt->bind_param('ss', $username, $password);
      $stmt->execute();
      $stmt->bind_result($id, $username, $password);
      $stmt->store_result();
      
      if($stmt->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        header('Location: user.php');
      }
      else {
        echo '<h3 id="error-message">Invalid Username/Password</h3>';
      }
    }
?>
  <style>
    #error-message {
      text-align: center;
      color: red;
    }

    #login {
      font-size: 160%;
      text-align: center;
      line-height: 150%
    }

    .login-input {
      font-size: 80%;
    }

    #login-button {
      font-size: 80%;
      width: 20%;
    }
  </style>

    <div id="login">
      <form method="POST">
        <br>
        <br>
        <label class="login-label"><b>Username</b></label>
        <br>
        <input name="username" class="login-input" type="text" placeholder="Enter Username">
        <br>
        <label class="login-label"><b>Password</b></label>
        <br>
        <input name="password" class="login-input" type="password" placeholder="Enter Password">
        <br>
        <button name="login-button" type="submit" id="login-button">Login</button>
      </form> 
    </div>
  </body>
</html>