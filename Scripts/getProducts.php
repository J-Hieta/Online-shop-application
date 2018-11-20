

<?php
include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";

foreach($pProduct as $product) {
            echo '<div style="padding-right: 1px" class="col-sm-5">
            <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
            <h3>'.$product['product_name'].'</h3><p>'.$product['product_price'].'</p>
            <button onclick="">Add to cart</button></div>';
            } ?>