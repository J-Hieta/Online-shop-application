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
    let minPrice = $("#min-price").val();
    let maxPrice = $("#max-price").val();
    window.location.href = "../layouts/searchResult.php?category="+searchCategory+"&input="+userInput+"&minP="+minPrice+"&maxP="+maxPrice;  //Go to search result page with given parameters.
}