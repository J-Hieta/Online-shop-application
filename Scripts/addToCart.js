//Add an item to the cart
function addToCart(id) {

    var product_id = $('#'+id).attr('id');
    var product_name = $('#'+id+'_name').val();
    var product_price = $('#'+id+'_price').val();
    var product_image = $('#'+id+'_img').attr('src');

    $.ajax({ 
        url: '../Scripts/addToCart.php',
        data: {'product_id' : product_id,
            'product_name' : product_name,
            'product_price' : product_price,
            'product_image' : product_image},
        type: 'post',
        success:function(){
            alert('Item added!');
        }
    });
}
