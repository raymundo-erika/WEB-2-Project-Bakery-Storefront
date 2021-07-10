$(document).ready(function(){
    viewPage(null, 1);
    displayPagination();
});



function displayCategories() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("categories").innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", "php/displayCategories.php", true);
    xhr.send();
}

function viewPrevPage(button) {
    
    if(button!=null) {
        var btnActive = document.getElementsByClassName("page-active")[0];
        btnActive.classList.remove("page-active");
        button.classList.add("page-active");


        isFinite

    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("products").innerHTML = xhr.responseText;
        }
    }

    var category = location.search.split('category=')[1];


    xhr.open("GET", "php/viewPage.php?category=" + category + "&pageNo="+pageNo, true);
    xhr.send();
}

function displayPagination() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementsByClassName("pagination")[0].innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", "php/displayPagination.php", true);
    xhr.send();
}

