<?php 
  include_once 'header\header.html'; 
?>

  <style>      
    body {
      text-align: center;
    }
    
    .flag {
      font-size: 150%;
    }

    #mystery {
      font-size: 200%;
      background: rgba(220, 220, 220, 0.6);
      color: blue;
    }
  </style>
    <br>
    <br>
    <form method="POST">
      <div id="input-flag">
        <input name="input" class="flag" placeholder="Enter Flag">
        <button name="enter" class="flag" type="submit">Enter</button>
      </div>
    </form>

    <?php
      if(isset($_POST['enter'])) {
        if($_POST['input'] == '$6y]vkSA;-8Sd}+c') {
          echo '<h1 id="mystery">Congratulations You Captured the Flag!<br>And Won a Million Dollars!</h1>';
        }
      }
    ?>
    </div>
  </body>
</html>