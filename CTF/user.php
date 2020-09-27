<?php 
    include_once 'include/session.inc.php';
    include_once 'include/db.inc.php';
    include_once 'header/header.html'; 

    if(!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header('Location: login.php');
    }
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
    }

    echo '<br><br><h1 class="welcome">Welcome Back '.$_SESSION['username'].'!</h1>';
    if($_SESSION['username'] == 'admin') {
        echo '<h1 class="welcome">Flag=$6y]vkSA;-8Sd}+c</h1>';
    }
?>
    <style>
        .welcome {
            text-align: center;
        }
        #logout {
            font-size: 200%;
            position: absolute;
            right: 5%;
            bottom: 5%;
        }
    </style>

        <form method="POST">
            <button type="submit" id="logout" name="logout"><b>LOGOUT</b></button>
        </form>
    </body>
</html>