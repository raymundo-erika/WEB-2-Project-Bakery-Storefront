$(document).ready(function () {
    
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