function getCategory(categoryId) {
    let mCategory = $(categoryId);
    return mCategory;
}

//Select product category to be displayed
function getProducts(categoryId) {
    let category = getCategory(categoryId);
    window.location.href = "../layouts/index.php?category=" + category.attr('id'); //Set selected category to URL
}


//Execute advanced search
function searchProducts() {
    let searchCategory = $("#search-category").val();
    let userInput = $("#search-input").val();
    window.location.href = "../layouts/getProducts.php?category="+searchCategory+"&input="+userInput;  //Go to search result page with given parameters.
}