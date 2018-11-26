<head>
<script src="../Scripts/addtoCart.js"></script>
</head>
<?php
include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";

foreach($pProduct as $product) {
            echo 
            '<div id="'.$product['product_id'].'" style="padding-right: 1px" class="col-sm-5">
                <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
                <h3>'.$product['product_name'].'</h3>
                <p>'.$product['product_price'].'</p>
                <button onclick="addToCart('.$product['product_id'].')">Add to cart</button>
            </div>
            <input id="'.$product['product_id'].'_name" type=hidden value="'.$product['product_name'].'"></input>
            <input id="'.$product['product_id'].'_price" type="hidden" value="'.$product['product_price'].'"></input>';
        } 
?>

