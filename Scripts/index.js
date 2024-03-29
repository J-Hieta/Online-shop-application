$('#advanced_options').hide();

function getCategory(categoryId) {
    let mCategory = $(categoryId);
    return mCategory;
}

//Select product category to be displayed
function getProducts(categoryId) {
    let category = getCategory(categoryId);
    window.location.href = "../layouts/index.php?category=" + category.attr('id'); //Set selected category to URL
}

function showAdvanced() {
    if ($('#advanced_text').text() === 'Advanced Search') {
        $('#advanced_options').slideDown('slow', () => {
            $('#advanced_text').text('Hide Advanced Options')
            .append('<span class="glyphicon glyphicon-collapse-up"></span>');
        });
    }
    else {
        $('#advanced_options').slideUp('slow', () => {
            $('#advanced_text').text('Advanced Search')
            .append('<span class="glyphicon glyphicon-collapse-down"></span>');
        });
    }
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