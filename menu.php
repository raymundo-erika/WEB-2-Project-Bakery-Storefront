<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patisserie - Cake</title>
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web\css\all.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
    <nav>   
        <!-- <div id="banner"><button id="nav-create-cake">Create your own cake</button></div> -->
        <ul class="horizontal">
            <a href="index.html"><li id="nav-logo"></li></a>
            <li class="category">
                <a href="index.html">Home</a>
            </li>
            <li class="category"><a href="menu.php?category=cake">Cakes</a></li>
            <li class="category"><a href="menu.php?category=cupcake">Cupcakes</a></li>
            <li class="category"><a href="menu.php?category=cheese_cake">Cheese cakes</a></li>
            <li class="category"><a href="menu.php?category=croissant">Croissants</a></li>
            <li class="category"><a href="menu.php?category=donut">Donuts</a></li>
            <li>
                <input type="text" id="nav-search" placeholder="Search" onenter="">
            </li>
            <li><i class="icon far fa-heart"></i></li>
            <li id="nav-cart">
                <span>10</span>
                <i class="icon fas fa-shopping-cart"></i>
            </li>
            <li>
                <i class="icon far fa-user-circle"></i>
                <ul class="dropdown">
                    <li><a href="">Account Settings</a></li>
                    <li><a href="">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    
    <div id="menu">
        <h1 class="title">Patisserie’s Cupcakes</h1>
        <p class="title-sub">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae erat in lacus mattis bibendum. Nullam dignissim commodo risus, nec blandit libero accumsan in.</p>

        <div id="products">
            <!-- <div class="product">
                <div class="product-img">
                    <img src="images/category/cake/UbeCastardCake.png">
                </div>
                <div class="title">Ube Castard Cake</div>
                <div class="desc">Red-brown, crimson, or scarlet-colored chocolate layer cake, layered with ermine icing</div>
                <div class="price">&#8369;750.00</div>
                <div class="action-buttons">
                    <button class="btn-addToCart"><i class="icon fas fa-shopping-cart"></i>&nbsp;&nbsp;Add to cart</button>
                    <button class="btn-wishList"><i class="far fa-heart"></i></button>
                </div>
            </div> -->

        </div>

        <div class="pagination">
            <!-- <a href="#" class="disabled"><i class="fas fa-chevron-left"></i></a>
            <a class="page-active" href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#"><i class="fas fa-chevron-right"></i></a> -->
        </div>

    </div>
    
    <div class="cart-container">
        <div class="cart">
            <div class="cart-header">
                <i class="icon fas fa-shopping-cart"></i>
                <label>Cart</label>
                <span class="icon close" onclick="closeCart()">&times;</span>
            </div>
    
            
            <div class="cart-body">
                <!-- <div class="cart-item">
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
                </div> -->
                
            </div>
    

            <div class="cart-footer">
                <div class="cart-total">Total: <b>&#8369;750.00</b></div>
                <div class="btn-checkout"><i class="icon fas fa-shopping-cart"></i>Checkout</div>
            </div>
        </div>
        <div class="cart-overlay" onclick="closeCart()"></div>
    </div>

    <!--chatbox-->
    <div class="message-container">
        <div class="message-nav">
            <div class="message-pic" style="background-image: url(images/users/sample.jpeg)">
                <span class="message-user-status"></span>
            </div>
            <div class="message-title">Sender name</div>
            <div class="icons">
                <span class="icon close">−</span>
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
                <b>10</b> Active Users
            </div>
            <i class="icon fas fa-chevron-up"></i>
        </div>
        <ul id="user-lists">
            <li onclick = 'showChat("")' class='user clearfix'>
                <div class='user-img' style='background-image: url(images/users/sample.jpeg)'></div>
                <div class='user-fullname'>erika</div>
             </li>
        </ul>
    </div>


   <!-- <script src="https://kit.fontawesome.com/6a07858133.js" crossorigin="anonymous"></script> -->
    <script src="fontawesome-free-5.15.3-web/js/all.js"></script>
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
    </script>

    <script src="js/cart.js"></script>
    <script src="js/menu.js"></script>
    <!-- <script src="js/product.js"></script> -->
</body>
</html>