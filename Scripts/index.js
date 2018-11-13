function getCategory(categoryId) {
    let category = $(categoryId);
    return category;
}

function getProducts(categoryId) {
    $('#products').remove();
    category = getCategory(categoryId);
    console.log(category)
    let product = $('#products-parent');
    console.log(product);
    let productElement =    `<div style="padding-right: 1px" class="col-sm-5">
                            <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
                            <h3>Product name</h3><p>Product price</p></div>`;

    product.append('<div id="products"></div>');
    $('#products').append(productElement);
}