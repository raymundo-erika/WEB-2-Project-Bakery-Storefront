$(document).ready(function () {

    userContainerOpen = false;
    
    loadActiveUsers();
    
    $("#upArrow4Message").click(function (e) { 
        e.preventDefault();
        if(!userContainerOpen){
            $(".users-container").css("height", "90vh");
            $(this).css("transform", "rotate(180deg)");
            $("#user-lists").css("display", "block");
            
            userContainerOpen = true;
        }else{
            $(".users-container").css("height", "7vh");
            $(this).css("transform", "rotate(0deg)");
            $("#user-lists").css("display", "none");
            userContainerOpen = false;
        }
        
    });


});
usernameee = "";
myLoading = setInterval(loadActiveUsers,10000);
myLoadingg = setInterval( function() { loadMessage(usernameee); }, 500 );




function loadActiveUsers(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#user-lists").html(xhr.responseText);
            $(".active-label b").html($("#activeUsersCounter").html());
        }
    }

    xhr.open("GET", "php/loadActiveUsers.php", true);
    xhr.send();
}

function showChat(username){
    usernameee = username;
    loadMessage(username);
    getFullName_Picture(username);
    $(".message-container").css("display", "block");
    $(".message-writer button").click(function (e) { 
        e.preventDefault();
        sendMessage(username);
    });

    $(".message-nav .close").click(function (e) { 
        e.preventDefault();
        $(".message-content").css("display", "block");
        $(".message-writer").css("display", "block");
        $(".message-container").css("display", "none");
        $(".message-nav .minimize").css("display", "block");
        $(".message-nav").css("cursor", "default");
    });

    $(".message-nav .minimize").click(function (e) { 
        e.preventDefault();
        $(".message-content").css("display", "none");
        $(".message-writer").css("display", "none");
        $(".message-nav").css("cursor", "pointer");
        $(".message-nav .minimize").css("display", "none");
        $(".message-title").click(function (e) { 
            e.preventDefault();
            $(".message-content").css("display", "block");
            $(".message-writer").css("display", "block");
            $(".message-nav .minimize").css("display", "block");
            $(".message-nav").css("cursor", "default");
        });
    });
    
}

function loadMessage(username) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
         $(".message-content").html(xhr.responseText);
        }
    }

    xhr.open("POST", "php/loadMessage.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("otherUser=" + username);
}

function getFullName_Picture(username){
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
         $(".message-title").html(xhr.responseText);
         imageUrl =  $("#otherUserImage").html();
         $(".message-nav .message-pic").css("background-image", 'url("' + imageUrl + '")');
         $(".sender .message-pic").css("background-image", 'url("' + imageUrl + '")');
         userProfilePict = $("#userProfilePic").html();
         $(".receiver .message-pic").css("background-image", 'url("' + userProfilePict + '")');
        }
    }

    xhr.open("GET", "php/getFullName_Picture.php?otherUser="+username, true);
    xhr.send();
}

function sendMessage(username){
    var xhr = new XMLHttpRequest();

    var now = new Date();
    var date = getMonth(now.getMonth()) + " " + now.getDate() + ", " + now.getFullYear(); 
    var time = getTime(now);
    var msgContent = $(".message-writer textarea").val();

    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            if(xhr.responseText == 1){
              $(".message-writer textarea").val("");
              loadMessage(username);
              getFullName_Picture(username);
            }
        }
    }

    xhr.open("POST", "php/sendMessage.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("receiver=" + username + "&msgContent=" + msgContent + "&date=" + date + "&time=" + time);
}

function getMonth(m){

    var month;

    switch(m) {
        case 0:
            month = "January";
            break;
        
        case 1:
            month = "February";
            break;
        
        case 2:
            month = "March";
            break;
        
        case 3:
            month = "April";
            break;
        
        case 4:
            month = "May";
            break;
        
        case 5:
            month = "June";
            break;
        
        case 6:
            month = "July";
            break;
        
        case 7:
            month = "August";
            break;
        
        case 8:
            month = "September";
            break;
        
        case 9:
            month = "October";
            break;
        
        case 10:
            month = "November";
            break;
        
        case 11:
            month = "December";
            break;
        
        case 12:
            month = "January";
            break;
        
        default:
            break;
    }

    return month;
}

function getTime(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? "pm" : "am";
    hours %= 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    return hours + ":" + minutes + " " + ampm;
  }