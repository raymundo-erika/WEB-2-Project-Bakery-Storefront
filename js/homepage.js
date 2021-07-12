$(document).ready(function(){

    displayFeaturedProducts();
    displayCategories();
    displayItems();
    displayPagination();
});


function displayCategories() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#categories").html(xhr.responseText);
        }
    }

    xhr.open("GET", "php/displayCategories.php", true);
    xhr.send();
}

function displayItems() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#products").html(xhr.responseText);
        }
    }

    xhr.open("GET", "php/displayItems.php", true);
    xhr.send();
}


function displayPagination() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $(".pagination").html(xhr.responseText);
        }
    }

    xhr.open("GET", "php/displayPagination.php", true);
    xhr.send();
}

function displayFeaturedProducts() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#featuredSlide").html(xhr.responseText);
        }
    }

    xhr.open("GET", "php/displayFeaturedProducts.php", true);
    xhr.send();
}