$(document).ready(function(){
    viewPage(1);
});

function displayCategories() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("categories").html(xhr.responseText);
        }
    }

    xhr.open("GET", "php/displayCategories.php", true);
    xhr.send();
}

function viewPage(pageNo) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#products").html(xhr.responseText);
        }
    }

    var category = location.search.split('category=')[1];


    xhr.open("GET", "php/viewPage.php?category=" + category + "&pageNo="+pageNo, true);
    xhr.send();

    displayPagination(pageNo);
}

function displayPagination(clickedPage) {
    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = () => {
        if (xhr1.readyState == 4 && xhr1.status == 200) {
            $(".pagination").first().html(xhr1.responseText);
        }
    }
    
    var category = location.search.split('category=')[1];
    var current_page = $(".page-active").first();
    var current_page_no = 1;

    if(current_page!=null) {
        current_page_no = current_page.value;
    }

    xhr1.open("GET", "php/displayPagination.php?category=" + category + 
                    "&current_page="+current_page_no + 
                    "&clicked_page="+clickedPage, true);
    xhr1.send();
}

