<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web 2 Project</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web\css\all.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>
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
                <input type="text" id="nav-search" placeholder="Search" onkeyup="search(this.value)" autocomplete="off">
            </li>
            <li><a href="wishlist.php"><i class="icon far fa-heart"></i></a></li>
            <li id="nav-cart">
                <span>10</span>
                <i class="icon fas fa-shopping-cart" onclick="openCart()"></i>   
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
    <div class="searchSuggestionContainer">
        <ul id="suggestionList">
            
        </ul>
    </div>
    

    <div id="left-info">
    <div id="left-container">
    
        <h1 id="heading-contact">Contact Information</h1>

        <table id="tbl-account-info">
        <tr>
            <td rowspan="2">
            <div id="img-rounded"><img width="50" src="" alt="profile-picture"></div>
            </td>
            <td class="account-info">
            fullname and email
            </td>
        </tr>
        </table>


        <form name="formShippingInfo" action="payment.php" onsubmit="return validateForm()" method="post">
        <h1 id="heading-shipping">Shipping Address</h1>
        <p>Fill up the following fields correctly, this is where your purchased items will be delivered.</p>
        <span id="required-label" class="subtitle"></span>

        <table id="tbl-shipping">

        <tr>
            <td colspan="2">
            <label for="address">House No, Building, Street* </label>
            <input type="text" id="address" name="address" placeholder="" 
                    value="">
            <span id="validation-add" class="validation-label"></span>
            </td>
        </tr>
        
        <tr>
            <td>
            <label for="city">Barangay* </label>
            <input type="text"  id="brgy" name="brgy" placeholder=""
                    value="">
            <span id="validation-city" class="validation-label"></span>
            </td>
        
            <td>
            <label for="city">City* </label>
            <input type="text"  id="city" name="city" placeholder=""
                    value="">
            <span id="validation-city" class="validation-label"></span>
            </td>
        </tr>
        
        <tr>
            <td colspan="2">
            <label for="province">Province* </label>
            <input type="text"  id="province" name="province" placeholder=""
                    value="">
            <span id="validation-province" class="validation-label"></span> 
            </td>
        </tr>

        <tr>
            <td>
            <label for="region">Region* </label>
            <select id="region" name="region">
            <?php

            // $region = ['National Capital Region', 'Cordillera Administrative Region', 'Ilocos Region',
            //             'Cagayan Valley', 'Central Luzon', 'Calabarzon', 'Southwestern Tagalog Region',
            //         'Bicol Region', 'Western Visayas', 'Central Visayas', 'Eastern Visayas', 'Zamboanga Peninsula',
            //         'Northern Mindanao', 'Davao Region', 'Soccsksargen', 'Caraga', 'Bangsamoro'];

            // foreach ($region as $r) {
            // if(isset($_SESSION['Address'])) {
            //     if ($_SESSION['Address'][5] == $r) {
            //     echo "<option value='$r' selected> $r </option>";
            //     } else {
            //     echo "<option value='$r'> $r </option>";
            //     }
            // } else {
            //     echo "<option value='$r'> $r </option>";
            // }
            
            // }


            // ?>
            <option value='region'> region </option>
            </select>
            <span id="validation-region" class="validation-label"></span>
            </td>
            
            <td>
            <label for="postal_code">Postal Code* </label>
            <input type="number"  id="postal_code" name="postal_code" placeholder=""
                    value="">
            <span id="validation-city" class="validation-label"></span>
            </td>
        </tr>

        <tr>
            <td colspan="2">
            <label for="landmark1">Landmark* </label>
            <input type="text"  id="landmark1" name="landmark1" placeholder="" 
                    value="">
            <span id="validation-landmark1" class="validation-label"></span>
            </td>
        </tr>

        <tr id="button-area">
            <td><a href="../index.php">< Return to home</a></td>
            <td><input type="submit" value="Continue to Payment"></td>
        </tr>
        </table>

        </form>
    </div>
    </div>
    <div id="right-cart">
    <div class="purchase-items" id="">
      <table>
        <caption>Your Cart</caption>
        <tr class="row1">
          <td class="image-item" rowspan="2"><img src=""></td>
          <td> product name</td>
          <td class="qty">product qunatity</td>
          <td class="price">&#8369; totalPrice </td>
        </tr>
        <tr class="row2">
          <td colspan="3">
            <small>
              Color: Color<br>
              Unit Price: &#8369; unitPrice
            </small>
            <br>
            <br>
          </td>
        </tr>
      </table>  

    </div>
    
    <hr>
    <table id="payment-info">
        <tr>
          <td>Subtotal</td>
          <td><strong>&#8369; TempTotalAmount</strong></td>
          </tr>
        <tr>
          <td>Shipping</td>
          <td><strong>Computed at next step</strong></td>
        </tr>
    </table>

    <hr>
      
      <table id="total-area">
        <tr>
          <td>Total: </td>
          <td><strong>&#8369; TempTotalAmount</strong></td>
          </tr>
        <tr>
      </table>
  </div>

    <div id="about"></div>

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
            <li onclick = 'showChat("")' class='user clearfix'>
                <div class='user-img' style='background-image: url(images/users/sample.jpeg)'></div>
                <div class='user-fullname'>erika</div>
             </li>
        </ul>
    </div>

    
    <!-- <script src="https://kit.fontawesome.com/6a07858133.js" crossorigin="anonymous"></script> -->
    <!-- <script src="fontawesome-free-5.15.3-web/js/all.js"></script> -->
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
    </script>

    <script src="js/cart.js"></script>
    <script src="js/messageFunctionalities.js"></script>
    <script src="js/search.js"></script>
    <script src="js/checkout.js"></script>

</body>
</html>
