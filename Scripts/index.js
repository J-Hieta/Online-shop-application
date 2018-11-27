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
$("#search_button").bind('click', function (event) {
    event.preventDefault()
    let searchCategory = $("#search-category").val();
    let userInput = $("#search-input").val();
    let minPrice = $("#min-price").val();
    let maxPrice = $("#max-price").val();
    let form = $('#search')[0];
    window.location.href = "../layouts/searchResult.php?category="+searchCategory+"&input="+userInput+"&minP="+minPrice+"&maxP="+maxPrice;
    console.log("lol");
    try {
        if(form.checkValidity()) {
            ;
            console.log("jee"); 
            window.location.href = "../layouts/searchResult.php?category="+searchCategory+"&input="+userInput+"&minP="+minPrice+"&maxP="+maxPrice;  //Go to search result page with given parameters.
        }
    } catch(error){
        console.log(error);
    }
    


}); 