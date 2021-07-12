<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: loginRegister.html");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/homepage.css">
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <script src="js/nav.js"></script>

</head>

<body>
    <nav>
        <ul class="horizontal">
            <a href="index.php">
                <li id="nav-logo"></li>
            </a>
            <li class="category">
                <a href="index.php">Home</a>
            </li>

            <section class="category-container" style="display: inline-block"></section>
            
            <li>
                <input type="text" id="nav-search" placeholder="Search" onkeyup="search(this.value)" autocomplete="off">
            </li>
            <li><a href="wishlist.html"><i class="icon far fa-heart"></i></a></li>
            <li id="nav-cart">
                <span id="cartItems"></span>
                <i class="icon fas fa-shopping-cart" onclick="openCart()"></i>
            </li>
            <li>
                <i class="icon far fa-user-circle"></i>
                <ul class="dropdown">
                    <li><a href="">Account Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="searchSuggestionContainer">
        <ul id="suggestionList">
        </ul>
    </div>

    <div id="slideshow">
        <div class="radios">
            <input class="slide-radio" type="radio" name="r" id="r1" onclick="slideshow(0)" checked>
            <input class="slide-radio" type="radio" name="r" id="r2" onclick="slideshow(1)">
            <input class="slide-radio" type="radio" name="r" id="r3" onclick="slideshow(2)">
        </div>
        <div class="swiper-slide" id="featuredSlide"></div>
        <div class="slider-pagination">
            <label for="r1" class="slide-nav active" id="slideNav1"></label>
            <label for="r2" class="slide-nav" id="slideNav2"></label>
            <label for="r3" class="slide-nav" id="slideNav3"></label>
        </div>
    </div>

    <div id="menu">
        <h1 class="title">Taste the sweetness</h1>
        <p class="title-sub">Patisserie offers the best cakes and sweets for you.</p>

        <div id="categories"></div>

        <div id="products"></div>

    </div>
    </div>

    <div id="about">
        <div class="content">
            <h1>About Patisserie</h1>
            <div class=image-con>
                <img src="images/category/cake/cake.png" alt="">
            </div>
            <div class="about-text">
                <p>All of our products are made from our<br />scratch using family recipes with only<br />the highest
                    quality ingredients. We<br />bake and sell fresh daily to ensure<br />only the best products are
                    sold to<br />our customers.</p>
            </div>
        </div>

    </div>

    <div class="cart">
        <div class="cart-header">
            <i class="icon fas fa-shopping-cart"></i>
            <label>Cart</label>
            <span class="icon close" onclick="closeCart()">&times;</span>
        </div>


        <div class="cart-body">
            <div class="cart-item">
                <div class="icon close">&times;</div>
                <div class="cart-item-image-left">
                    <img src="images/category/cake/PasteldeTresLechesCake.png">
                </div>
                <div class="cart-item-right">

                    <div class="cart-item-title">
                        Cake de la feur
                    </div>
                    <div class="cart-item-desc">
                        Size: <b>16" x 12"</b> Price: <b>&#8369;750.00</b>
                    </div>
                    <div class="cart-item-qty-price">
                        <div class="cart-item-qty">
                            <button>+</button>
                            <input type="text" value=1 readonly>
                            <button>-</button>
                        </div>
                        <div class="cart-item-price">&#8369;750.00</div>

                    </div>

                </div>
            </div>

            <div class="cart-item">
                <div class="icon close">&times;</div>
                <div class="cart-item-image-left">
                    <img src="images/category/cake/PasteldeTresLechesCake.png">
                </div>
                <div class="cart-item-right">

                    <div class="cart-item-title">
                        Cake de la feur
                    </div>
                    <div class="cart-item-desc">
                        Size: <b>16" x 12"</b> Price: <b>&#8369;750.00</b>
                    </div>
                    <div class="cart-item-qty-price">
                        <div class="cart-item-qty">
                            <button>+</button>
                            <input type="text" value=1 readonly>
                            <button>-</button>
                        </div>
                        <div class="cart-item-price">&#8369;750.00</div>

                    </div>

                </div>
            </div>

            <div class="cart-item">
                <div class="icon close">&times;</div>
                <div class="cart-item-image-left">
                    <img src="images/category/cake/PasteldeTresLechesCake.png">
                </div>
                <div class="cart-item-right">

                    <div class="cart-item-title">
                        Cake de la feur
                    </div>
                    <div class="cart-item-desc">
                        Size: <b>16" x 12"</b> Price: <b>&#8369;750.00</b>
                    </div>
                    <div class="cart-item-qty-price">
                        <div class="cart-item-qty">
                            <button>+</button>
                            <input type="text" value=1 readonly>
                            <button>-</button>
                        </div>
                        <div class="cart-item-price">&#8369;750.00</div>

                    </div>

                </div>
            </div>
            <div class="cart-item">
                <div class="icon close">&times;</div>
                <div class="cart-item-image-left">
                    <img src="images/category/cake/PasteldeTresLechesCake.png">
                </div>
                <div class="cart-item-right">

                    <div class="cart-item-title">
                        Cake de la feur
                    </div>
                    <div class="cart-item-desc">
                        Size: <b>16" x 12"</b> Price: <b>&#8369;750.00</b>
                    </div>
                    <div class="cart-item-qty-price">
                        <div class="cart-item-qty">
                            <button>+</button>
                            <input type="text" value=1 readonly>
                            <button>-</button>
                        </div>
                        <div class="cart-item-price">&#8369;750.00</div>

                    </div>

                </div>
            </div>
        </div>


        <div class="cart-footer">
            <div class="cart-total">Total: <b>&#8369;750.00</b></div>
            <div class="btn-checkout"><i class="icon fas fa-shopping-cart"></i>Checkout</div>
        </div>
    </div>
    <div class="cart-overlay" onclick="closeCart()"></div>


    <!--chatbox-->
    <div class="message-container">
        <div class="message-nav">
            <div class="message-pic">
                <span class="message-user-status"></span>
            </div>
            <div class="message-title">Sender name</div>
            <div class="icons">
                <span class="icon minimize">−</span>
                <span class="icon close">&times;</span>
            </div>
        </div>
        <div class="message-content">
            <div class="message-item sender">
                <div class="message-item-info">
                    <div class="message-pic"></div>
                    <div class="message-details">
                        <label class="message">Hello!</label>
                        <label class="sent-date">July 9, 2021 9:31pm</label>
                    </div>
                </div>
            </div>

            <div class="message-item receiver">
                <div class="message-item-info">
                    <div class="message-details">
                        <label class="message">Hello!</label>
                        <label class="sent-date">July 9, 2021 9:31pm</label>
                    </div>
                    <div class="message-pic"></div>
                </div>
            </div>
        </div>
        <div class="message-writer">
            <textarea placeholder="Write your message..."></textarea>
            <button>Send<img src="images/icons/send.png"></button>
        </div>
    </div>


    <!--Active users-->
    <div class="users-container">
        <div class="header">
            <div class="active-label">
                <b> </b> Active Users
            </div>
            <i class="icon fas fa-chevron-up" id="upArrow4Message"></i>
        </div>
        <ul id="user-lists">
            <li onclick='showChat("")' class='user clearfix'>
                <div class='user-img' style='background-image: url(images/users/sample.jpeg)'></div>
                <div class='user-fullname'>erika</div>
            </li>
        </ul>
    </div>


    <script src="https://kit.fontawesome.com/6a07858133.js" crossorigin="anonymous"></script>
    <script src="js/homepage.js"></script>
    <script src="js/wishlist.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/messageFunctionalities.js"></script>
    <script src="js/search.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function slideshow(slideNo) {

            $(".slide-radio").each(function() {
                var id = $(this).attr("id");
                $("label[for='"+id+"']").removeClass("active");
            });

            $(".slide-radio:checked").each(function() {
                var id = $(this).attr("id");
                $("label[for='"+id+"']").addClass("active");
            });

            var pos = slideNo * -100;
            var position = pos + "vw";

            $("#featuredSlide").animate({
                left: position
            }, 400);
        }
    </script>

</body>

</html>