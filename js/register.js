function registerUser() {

    //Trim Added
    un = $("#reg-un").val().trim();
    pass = $("#reg-pass").val();
    email = $("#reg-email").val().trim();
    fullname = $("#reg-fullname").val().trim();
    address = $("#reg-address").val().trim();
    birthdate = $("#reg-bday").val().trim();

    

    if (un == "" || pass == "" || email == "" || fullname == "" || address == "" || birthdate == ""||!validcap()) {
        if(!validcap()){
            swal("Incorrect captcha.", "Please try again.", "info");
        }else{
            swal("Please fill up all the fields.", "Provide your valid information.", "info");
        }
        

    } else {
        xhr = new XMLHttpRequest();

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText == "0") {
                    swal("Duplicate username and email.","Maybe you want to login instead?", {
                        buttons: {
                          cancel: "Cancel",
                          "Login": true,
                        },
                      })
                      .then((value) => {
                        switch (value) {
                       
                          case "Login":
                              openLogin();
                            break;
                       
                          default:
                        }
                      });

                } else if (xhr.responseText == "1") {
                    swal("Duplicate username!", "Please create a new username", "info");
                } else if (xhr.responseText == "2") {
                    swal("Duplicate email!", "Please create a new email", "info");
                } else {
                    register();
                }
            }
        }

        xhr.open("POST", "php/checkForDuplications.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("username=" + un + "&email="+email);
    }

}

//contains the main registration code, we separated it for better readability
function register() {
    xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            swal("You are now registered!", "You can now proceed to the login.", "success", {
                button: "Login!",
              });
            openLogin();
        }
    }

    
    un = $("#reg-un").val().trim();
    pass = $("#reg-pass").val();
    email = $("#reg-email").val().trim();
    fullname = $("#reg-fullname").val().trim();
    address = $("#reg-address").val().trim();
    birthdate = $("#reg-bday").val().trim();

    xhr.open("POST", "php/register.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("username=" + un + "&password=" + pass + "&email=" + email + "&fullName=" + fullname + "&address=" + address + "&birthdate=" + birthdate);
}

function cap() {

    var alpha=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V'
               ,'W','X','Y','Z','1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i',
               'j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

    var a=alpha[Math.floor(Math.random()*62)];
    var b=alpha[Math.floor(Math.random()*62)];
    var c=alpha[Math.floor(Math.random()*62)];
    var d=alpha[Math.floor(Math.random()*62)];
    var e=alpha[Math.floor(Math.random()*62)];
    var f=alpha[Math.floor(Math.random()*62)];

    var sum=a + b + c + d + e + f;

    document.getElementById("capt").value=sum;
}

function validcap() {
    var string1 = document.getElementById('capt').value;
    var string2 = document.getElementById('textinput').value;
    if (string1 == string2){
        return true;
    }
    else {
        return false;
    }
}
