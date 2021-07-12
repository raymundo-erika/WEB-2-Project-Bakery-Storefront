$(document).ready(function(){
    viewPageByCategory(1);
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
