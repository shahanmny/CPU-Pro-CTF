<?php 
  include_once 'include/session.inc.php';
  include_once 'include/db.inc.php';
  include_once 'header/header.html'; 

  if(isset($_GET['product-remove'])) {
    for($i = 0; $i < sizeOf($_SESSION['cart']); $i++) {
      if($_SESSION['cart'][$i] == $_GET['product-remove']) {
        array_splice($_SESSION['cart'], $i, 1);
        break;
      }
    }
  }
?>  

  <style>
    .grid-container {
      display: grid;
      grid-template-columns: 60% 25% 15%;
      background: rgba(220, 220, 220, 0.6);
      }

    .product-name {
      grid-column-start: 1;
      grid-column-end: 2;
      font-size: 200%;
    }

    #product-name {
      margin-block-start: 0px;
      margin-block-end: 0px;
      padding-left: 5%;
    }

    .product-price {
      grid-column-start: 2;
      grid-column-end: 3;
      font-size: 200%;
      margin-top: 0px 0px;
    }

    #product-price {
      margin-block-start: 0px;
      margin-block-end: 0px;
    }

    .product-remove {
      grid-column-start: 3;
      grid-column-end: 4;
    }

    #product-remove {
      font-size: 200%;
      background: none;
      border: none;
      color: #069;
      text-decoration: underline;
      cursor: pointer;
    }

    .border {
      background-color: white;
    }

    #total {
      padding-left: 5%;
      font-size: 205%;
    }
  </style>

  <div class="grid-container">
    <?php

      if(isset($_SESSION['cart'])) {
        $total = 0;
        foreach($_SESSION['cart'] as $id){
          $sql = 'SELECT * FROM cpu_processors WHERE id='.$id.';';
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo '<br>
                    <div class="product-name">
                      <h3 id="product-name">'.$row['name'].'</h3>
                    </div>
                    <div class="product-price">
                      <h3 id="product-price">'.$row['price_display'].'</h3>
                    </div>
                    <form method="GET">
                      <div class="product-remove">
                        <button type="submit" id="product-remove" name="product-remove" value='.$id.'>Remove</button>
                      </div>
                    </form>
                    <br>';
              $total += $row['price'];
            }
          }
        }
        if($total > 0) {
          echo '<div class="product-name">
                  <h3 id="total">Total: $'.$total.'</h3>
                </div>';
        }
      }
    ?>
  </div>

  </body>
</html>