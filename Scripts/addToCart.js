$(document).ready(function(){

    $.ajax({
      
      url:'../Scripts/addToCart.php',
      data:{
        total_cart_items:"itemsInCart"
      },
      type:'post',
      success:function(response) {
        document.getElementById("items_in_cart").value=response;
      }
    });
});


function addToCart(id) {

    var product_id = $('#'+id).attr('id');
    var product_name = $('#'+id+'_name').val();
    var product_price = $('#'+id+'_price').val();

    $.ajax({ 
        url: '../Scripts/addToCart.php',
        data: {'product_id' : product_id,
            'product_name' : product_name,
            'product_price' : product_price},
        type: 'post',
        success:function(){
            alert('Item added!');
        }
    });
}

function goToCart()
{
    $.ajax({
        url:'cart.php',
        data:{
            'showcart' : "cart"
        },
        type:'post',
        success:function() {
            window.location.href = "../Layouts/cart.php"
        }
 });

}