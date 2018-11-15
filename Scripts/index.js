function getCategory(categoryId) {
    let category = $(categoryId);
    return category;
}

function getProducts(categoryId) {
    $('#products').remove();
    
    category = getCategory(categoryId);
    window.location.href = "../layouts/index.php?category=" + category.attr('id');
    $('#products').append(productElement);
}