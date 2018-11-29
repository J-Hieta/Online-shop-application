<head>
<script src="../Scripts/addtoCart.js"></script>
</head>
<?php
include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";

foreach($pProduct as $product) {
            echo 
            '<div id="'.$product['product_id'].'" style="padding: auto; flex-wrap:;align-content: center" class="col-sm-4">
                <img id="'.$product['product_id'].'_img" src='.$product['product_image_path'].' class="img-responsive" style="width:200px;height:200px" alt="Image">
                <h3 align="center">'.$product['product_name'].'</h3>
                <p align="center">'.$product['product_price'].' €</p>
                <div class="text-center">
                    <button  style="margin-bottom: 2%" class="btn btn-success" onclick="addToCart('.$product['product_id'].')">Add to cart</button>
                </div>
            </div>
            
            <input id="'.$product['product_id'].'_name" type=hidden value="'.$product['product_name'].'"></input>
            <input id="'.$product['product_id'].'_price" type="hidden" value="'.$product['product_price'].'"></input>';
        }
 
?>

