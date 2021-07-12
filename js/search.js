$(document).ready(function () {
    $("#nav-search").on('keypress',function(e) {
        if(e.which == 13) {
            searchOnEnter($("#nav-search").val());
        }
    });
});

function search(toBeSearch) {
    if(toBeSearch.trim()!=""){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if(xhr.responseText!=0){
                    $("#suggestionList").html(xhr.responseText);
                    $(".searchSuggestionContainer").css("display", "block");
                }else{
                    $(".searchSuggestionContainer").css("display", "none");
                }
            }
        }
    
        xhr.open("GET", "php/search.php?toBeSearch="+toBeSearch, true);
        xhr.send();
    }else{
        $(".searchSuggestionContainer").css("display", "none");
    }
   
}

function openItemDisplay(prodID,categoryId){
    window.location.href = "product.php?id="+prodID+"&category="+categoryId;
}

function searchOnEnter(toBeSearch) {
    if(toBeSearch.trim()!=""){
        window.location.href = "search.html?toBeSearch="+toBeSearch;
    }
   
}