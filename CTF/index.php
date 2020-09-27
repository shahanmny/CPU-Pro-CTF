<?php 
  include_once 'include/session.inc.php';
  include_once 'include/db.inc.php';
  include_once 'header/header.html';
  
  if(isset($_GET['search'])) {
    $_SESSION['searchResult'] = $_GET['searchResult'];
  }

  if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }
  if(isset($_GET['product-button'])) {
    array_push($_SESSION['cart'], $_GET['product-button']);   
  }
?>

  <style>
    .grid-container {
      display: grid;
      grid-template-columns: 20% 1fr;
    }

    #sidebar {
      grid-column-start: 1;
      grid-column-end: 2;
      font-size: 110%;
      width: 11%;
      padding: 5px 10px;
      line-height: 90%;
      background: rgba(220, 220, 220, 0.6);
      line-height: 125%;
      position: absolute;
      top: 16%;
      border: 2px solid white;
      float: left;
    }

    #dropDown {
      font-size: 90%;
      margin-top: 1%;
      margin: auto;
      width: 100%;
    }

    #update {
      margin-top: 10px;
      font-size: 115%;
      height: 50%;
      width: 60%;
      transform: translateX(32.25%);
    }

    #searchBar {
      text-align: center;
      margin-top: 1%;
    }

    #searchResult {
      width: 30%;
      font-size: 125%;
    }

   #search {
      width: 5%;
      font-size: 125%;
    }
    
    #products {
      padding-top: 1%;
      grid-column-start: 2;
      grid-column-end: 3;
    }

    .product-container {
      border: 3px solid black;
      width: 80%; 
      background: rgba(220, 220, 220, 0.6);
      display: grid;
      grid-template-columns: 25% 50% 25%;
      grid-template-rows: 50% 50%;
      grid-template-areas:
      "product-image product-name product-price"
      "product-image product-brand product-benchmark";
    }

    .product-image {
      grid-area: product-image;
      width: 100%;
      height: auto;
      justify-self: start;  
    }

    .product-name {
      grid-area: product-name;
      font-size: 170%;
      padding-left: 10%;
    }
    
    .product-price {
      grid-area: product-price;
      font-size: 160%;
      text-align: right;
      padding-right: 15%;
    }

    .product-brand {
      grid-area: product-brand;
      font-size: 130%;
      padding-left: 10%;
    }

    .product-benchmark {
      grid-area: product-benchmark;
      font-size: 130%;
      text-align: right;
      padding-right: 15%;
    } 

    .product-button {
      font-size: 110%;
      background: none;
      border: none;
      padding: 0;
      color: #069;
      text-decoration: underline;
      cursor: pointer;
    }
  </style>

    <div id="searchBar">
      <form method="GET">
        <input type="text" placeholder="Search..." name="searchResult" id="searchResult">
        <button type="submit" id="search" name="search"><i class="fa fa-search"></i></button>
      </form>
      <br>
    </div>

    <div class="grid-container">
      <div id="sidebar">
        <form method="GET">

          <p><b>Filter</b></p>
          <select id="dropDown" name="dropDown"> 
            <option value="sortBy" selected <?php if(isset($_GET['dropDown']) && $_GET['dropDown'] =='sortBy'){echo "selected";}?>>Sort By...</option>
            <option value="lowestPrice" <?php if(isset($_GET['dropDown']) && $_GET['dropDown'] =='lowestPrice'){echo "selected";}?>>Lowest Price</option>
            <option value="highestPrice" <?php if(isset($_GET['dropDown']) && $_GET['dropDown'] =='highestPrice'){echo "selected";}?>>Highest Price</option>
            <option value="lowestBenchmark" <?php if(isset($_GET['dropDown']) && $_GET['dropDown'] =='lowestBenchmark'){echo "selected";}?>>Lowest Benchmark</option>
            <option value="highestBenchmark" <?php if(isset($_GET['dropDown']) && $_GET['dropDown'] =='highestBenchmark'){echo "selected";}?>>Highest Benchmark</option>
          </select>

          <p><b>Brand</b></p>
          <input type="radio" name="brand" value="-1" checked <?php if(isset($_GET['brand']) && $_GET['brand'] =='-1'){echo "checked";}?>>No Specification</input><br>
          <input type="radio" name="brand" value="Intel" <?php if(isset($_GET['brand']) && $_GET['brand'] =='Intel'){echo "checked";}?>>Intel</input><br>
          <input type="radio" name="brand" value="AMD" <?php if(isset($_GET['brand']) && $_GET['brand'] =='AMD'){echo "checked";}?>>AMD</input><br>

          <p><b>Price</b></p>
          <input type="radio" name="price" value="-1" checked <?php if(isset($_GET['price']) && $_GET['price'] =='-1'){echo "checked";}?>>No Specification</input><br>
          <input type="radio" name="price" value="0-250" <?php if(isset($_GET['price']) && $_GET['price'] =='0-250'){echo "checked";}?>>0 - $250</input><br>
          <input type="radio" name="price" value="251-500" <?php if(isset($_GET['price']) && $_GET['price'] =='251-500'){echo "checked";}?>>$251 - $500</input><br>
          <input type="radio" name="price" value="501-750" <?php if(isset($_GET['price']) && $_GET['price'] =='501-750'){echo "checked";}?>>$501 - $750</input><br>
          <input type="radio" name="price" value="751-1000" <?php if(isset($_GET['price']) && $_GET['price'] =='751-1000'){echo "checked";}?>>$751 - $1,000</input><br>
          <input type="radio" name="price" value="1001-1250" <?php if(isset($_GET['price']) && $_GET['price'] =='1001-1250'){echo "checked";}?>>$1,001 - $1,250</input><br>
          <input type="radio" name="price" value="1251-max" <?php if(isset($_GET['price']) && $_GET['price'] =='1251-max'){echo "checked";}?>>$1,251 and more</input><br>

          <P><b>BenchMark</b>
          <br><i>By PassMark Software</i></p>
          <input type="radio" name="benchmark" value="-1" checked <?php if(isset($_GET['benchmark']) && $_GET['benchmark'] =='-1'){echo "checked";}?>>No Specification</input><br>
          <input type="radio" name="benchmark" value="0-5000" <?php if(isset($_GET['benchmark']) && $_GET['benchmark'] =='0-5000'){echo "checked";}?>>0 - 5,000</input><br>
          <input type="radio" name="benchmark" value="5001-10000" <?php if(isset($_GET['benchmark']) && $_GET['benchmark'] =='5001-10000'){echo "checked";}?>>5,001 - 10,000  </input><br>
          <input type="radio" name="benchmark" value="10001-15000" <?php if(isset($_GET['benchmark']) && $_GET['benchmark'] =='10001-15000'){echo "checked";}?>>10,001 - 15,000</input><br>
          <input type="radio" name="benchmark" value="15001-20000" <?php if(isset($_GET['benchmark']) && $_GET['benchmark'] =='15001-20000'){echo "checked";}?>>15,001 - 20,000</input><br>
          <input type="radio" name="benchmark" value="20001-25000" <?php if(isset($_GET['benchmark']) && $_GET['benchmark'] =='20001-25000'){echo "checked";}?>>20,001 - 25,000</input><br>
          <input type="radio" name="benchmark" value="25000-max" <?php if(isset($_GET['benchmark']) && $_GET['benchmark'] =='25000-max'){echo "checked";}?>>25,000 and more</input><br>

          <button type="submit" id="update" name="update" value="update">Update</button>
          <br></br>
        </form>
      </div>
        
      <div id="products">
        <?php
          if(isset($_SESSION['searchResult']))
            echo '<script> document.getElementById("searchResult").value = "'.$_SESSION['searchResult'].'"; </script>';

          $sql = 'SELECT * FROM cpu_processors WHERE 1=1';
          
          if(isset($_SESSION['searchResult']) && $_SESSION['searchResult'] != '')
            $sql.= ' AND (name LIKE "%'.$_SESSION['searchResult'].'%" OR brand LIKE "%'.$_SESSION['searchResult']. '%")';
          
          if(isset($_GET['update'])) {

            $brand = $_GET['brand'];
            if($brand != "-1") {
              $sql.=' AND brand="'.$brand.'"';
            }

            $price= $_GET['price'];
            if($price != "-1") {
              $priceLow = substr($price, 0, strpos($price, '-'));
              $priceHigh = substr($price, (strpos($price, '-')+1), (strlen($price)-strpos($price, '-')));
              if($priceHigh == 'max')
                $priceHigh = '9999999';
              $sql.=' AND price BETWEEN '.$priceLow.' AND ' .$priceHigh;
            }

            $benchmark= $_GET['benchmark'];
            if($benchmark != "-1") {
              $benchmarkLow = substr($benchmark, 0, strpos($benchmark, '-'));
              $benchmarkHigh = substr($benchmark, (strpos($benchmark, '-')+1), (strlen($benchmark)-strpos($benchmark, "-")));
              if($benchmarkHigh == 'max')
                $benchmarkHigh = '9999999';
              $sql.=' AND benchmark BETWEEN '.$benchmarkLow.' AND ' .$benchmarkHigh;
            }

            $dropDown = $_GET['dropDown'];
            if($dropDown == "lowestPrice")
              $sql.=' ORDER BY price';
            elseif($dropDown == "highestPrice")
              $sql.=' ORDER BY price DESC';
            elseif($dropDown == "lowestBenchmark")
              $sql.=' ORDER BY benchmark';
            elseif($dropDown == "highestBenchmark")
              $sql.=' ORDER BY benchmark DESC';
          }
  
          $sql.=';';
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $imagePath = 'images/'.$row['id'].'.jpg';
              
              echo '<form method="GET">
                      <div class="product-container">
                        <div class="div-background"></div>
                        <img src='.$imagePath.' class="product-image">
                        <h3 class="product-name">'.$row['name'].'</h3>
                        <h3 class="product-price">'.$row['price_display'].'</h3>
                        <h3 class="product-brand">Brand: '.$row['brand'].'</h3>
                        <h3 class="product-benchmark">Benchmark: '.$row['benchmark_display'].'<br> <button type="submit" class="product-button" name="product-button" value='.$row['id'].'>Add to Cart</button></h3>
                      </div>
                    </form>';
            }
          }
        ?>
      </div>
  </body>
</html>