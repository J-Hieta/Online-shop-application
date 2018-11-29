<?php
include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";
session_start();
//Get category from url
 $category = "";
   if(isset($_GET['category'])) {
     $category = test_input($_GET['category']);
   }
  //Look for products with specified category
  $pProduct = $conn->query("SELECT * from products WHERE category like '$category'");

  if(isset($_POST['searchButton'])) {


  if($_POST['searchButton'] == "submit") {
    $input = test_input($_POST['input']);
    $searchCategory = test_input($_POST['category']);
    $minP = test_input($_POST['minP']);
    $maxP = test_input($_POST['maxP']);
    header("location: ../Layouts/searchresult.php?input=".$input."&category=".$searchCategory."&minP=".$minP."&maxP=".$maxP."");
  }
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Online store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../Styles/styles.css">
  <script src="../Scripts/index.js"></script>
</head>

<body>
  <!-- Navbar -->
  <?php include 'navbar.php'; ?>

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="../resources/productImages/computer4.jpg" style="width:500px ; height:285px" alt="Image">
        <div class="carousel-caption">
          <h3>Desktop PC</h3>
          <p>900€</p>
        </div>
      </div>

      <div class="item">
        <img src="../resources/productImages/keyboard.jpg" style="width:500px ; height:285px" alt="Image">
        <div class="carousel-caption">
          <h3>Keyboard</h3>
          <p>20€</p>
        </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  
  <h3 align="center">Products</h3><br>
  <div align="center" style="padding: 5px" class="search">

  <!-- Advanced search -->
  <form id="search" method="post">
  <div class="form input-group">
    <input required name="input" value="" id="search-input" type="text">
    <select required name="category" name="search-category" id="search-category">
        <option value="">Select category</option>
        <option value="computers">Computers</option>
        <option value="phones">Phones</option>
        <option value="accessories">Accessories</option>
      </select>
      <input required name="minP" value="" id="min-price" type="text" placeholder="min price" size="5" maxlength="5">
      -
      <input required name="maxP" value="" id="max-price" type="text" placeholder="max price" size="5" maxlength="5">
    <button id="search_button" class="btn btn-success" type="submit" name="searchButton" value="submit">Search</button>
  </div>
  </form>
  
  <!-- Category navbar -->
  </div>
  <div class="row ">
    <div style=" margin-right: auto" class="col-sm-2 sidenav hidden-xs">
      <table  class="table category-navbar table-bordered table-inverse">
        <thead>
          <th>Categories</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <a value="computers" id="computers" onclick="getProducts('#computers')">Computers</a>
            </td>
          </tr>
          <tr>
            <td>
              <a value="Phones" id="Phones" onclick="getProducts('#Phones')">Mobile phones</a>
            </td>
          </tr>
          <tr>
            <td>
              <a id="Accessories" onclick="getProducts('#Accessories')">Accessories</a>
            </td>
          </tr>
          <tr>
            <td>
              <a onClick="getProducts('#All')" id="All">All</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

      <!-- Product images, to be added in javascript -->
      <div id="products-parent" style="margin-left: 5% ; width: 70% ; display: inline-block ; float: left" class="col-sm-10">
        <?php
        if(isset($_GET['category']) && $_GET['category'] != 'All') {
          include '../Scripts/getProducts.php';
        }
        else if(isset($_GET['category']) && $_GET['category'] == 'All') {
          $pProduct = $conn->query("SELECT * from products");
          include '../Scripts/getproducts.php';
        }
        else {
          $pProduct = $conn->query("SELECT * from products ORDER BY RAND() LIMIT 6");
          include '../Scripts/getproducts.php';
        }
          
        ?>
    </div>
  </div>
  </div><br>
 
</body>
</html>