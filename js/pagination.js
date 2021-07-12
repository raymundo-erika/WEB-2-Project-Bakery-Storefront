
function viewPageByCategory(pageNo) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#products").html(xhr.responseText);
        }
    }

    var category = location.search.split('category=')[1];


    xhr.open("GET", "php/viewPage.php?category=" + category + "&pageNo="+pageNo, true);
    xhr.send();

    displayPaginationByCategory(pageNo);
}

function displayPaginationByCategory(clickedPage) {
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

    xhr1.open("GET", "php/displayPaginationByCategory.php?category=" + category + 
                    "&current_page="+current_page_no + 
                    "&clicked_page="+clickedPage, true);
    xhr1.send();
}


function viewPageBySearch(pageNo) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#products").html(xhr.responseText);
        }
    }

    var toBeSearch = location.search.split('toBeSearch=')[1];


    xhr.open("GET", "php/viewSearchPage.php?toBeSearch=" + toBeSearch + "&pageNo="+pageNo, true);
    xhr.send();

    displayPaginationBySearch(pageNo);
}


function displayPaginationBySearch(clickedPage) {
    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = () => {
        if (xhr1.readyState == 4 && xhr1.status == 200) {
            $(".pagination").first().html(xhr1.responseText);
        }
    }
    
    var toBeSearch = location.search.split('toBeSearch=')[1];
    var current_page = $(".page-active").first();
    var current_page_no = 1;

    if(current_page!=null) {
        current_page_no = current_page.value;
    }

    xhr1.open("GET", "php/displayPaginationBySearch.php?toBeSearch=" + toBeSearch + 
                    "&current_page="+current_page_no + 
                    "&clicked_page="+clickedPage, true);
    xhr1.send();
}
