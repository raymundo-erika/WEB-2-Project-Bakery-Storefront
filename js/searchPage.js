$(document).ready(function(){
    viewPageBySearch(1);
    
    var toBeSearch = location.search.split('toBeSearch=')[1];
    $("#titleSearch").html("Search Results for " + toBeSearch);
});
