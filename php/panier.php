<?php session_start();


function showCart()
{
  if (!empty($_SESSION['cart']))
  {
    for($i = 0 ; $i < count($_SESSION['cart']['id_product']) ; $i++)
    {
      
      ?>
         <tr>
            <td scope="row"><IMG  src="<?php echo  $_SESSION['cart']['url_image'][$i];?>" alt="cart.png"/>
               <span class="blue-text ml-4"><?php echo  $_SESSION['cart']['nom'][$i];?></span></td>
              <td class="align-middle"><?php echo  $_SESSION['cart']['prix'][$i]?>$</td>
              <td class="align-middle">
                <div class="col-3">
                    <input class="form-control" type="number" value="<?php echo $_SESSION['cart']['qte'][$i]?>">
                </div>
              </td>
              <td class="align-middle">$<?php echo   $_SESSION['cart']['prix'][$i];?></td>
              <td class="align-middle"><IMG  src="../IMAGES/cart-02.png" alt="cart-02.png"/></td>
          </tr>
      <?php
      
    }
  
  } 
}

function getCountCart(){
      
  if (!empty($_SESSION['cart'])){
    $count=0;
    for($i = 0 ; $i < count($_SESSION['cart']['id_product']) ; $i++)
    {
      $count= $_SESSION['cart']['qte'][$i] + $count;
    }
    echo $count;
  }else{
     echo 0;
  }
}

?>
<html>
    <HEAD>
            <link type="text/css" rel="stylesheet" href="./../CSS/softmarket.css" />
            <link
              rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous"
            />
            <link
              rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
            />
            
            <script
              src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
              integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
              crossorigin="anonymous"
            ></script>
            <script
              src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
              integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
              crossorigin="anonymous"
            ></script>
            <script
              src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
              integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
              crossorigin="anonymous"
            ></script>
        <TITLE> SoftMarket QAR</TITLE>
   </HEAD>
   <body>
        <div class="container">
        <header>
                <div class="navbar">
                  <span>Shop by Phone (01) 123 456 &nbsp;</span>
                  <span class="blue-text">Live Chat With Us</span>
                  <div class="ml-auto">
                  <button type="button" class="btn btn-online-primary dropdown-toggle" data-toggle="dropdown"><span class="blue-text">My Account &nbsp;</span></button> 
              | 
              <button type="button" class="btn btn-online-primary dropdown-toggle" data-toggle="dropdown" onclick="location.href='panier.php'"><span class="blue-text">My Cart (<span id="counter-cart"><?php getCountCart(); ?></span>) &nbsp;</span></button>
                  </div>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light ">
                  <img src="../IMAGES/img-01.png" alt="img-01.png" />
                  <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                  >
                    <span class="navbar-toggler-icon"></span>
                  </button>
          
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="#">OFFICE</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">MULTIMEDIA</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">DESIGN</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">DEVELOPER</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">UTILITIES</a>
                      </li>
                      <li class="nav-item mr-4">
                        <a class="nav-link" href="#">GAMES</a>
                      </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                      <!-- <input
                        class="form-control mr-sm-3"
                        type="search"
                        aria-label="Search"
                      /> -->
          
                      <div class="form-group has-search">
                          <input type="text" class="form-control" />
                          <span class="fa fa-search form-control-feedback"></span>
                      </div>
          
                    </form>
                  </div>
                </nav>
              </header>
            </div>
            <hr />
            <div class="container"> 
            <div class="row">
                <div class="col-md-12">
                    <span class="path">Home  >  Shopping Cart</span>
                    <H3>Shopping Cart</H3>
                </div>
                <div class="col-md-12">
                    Consecteur
                </div>
                <div class="col-md-12">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php showCart();?>
                                </tbody>
                            </table>
                </div>
                <div class="col-md-12">
                <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input class="form-control" type="text" value="Estimate Shopping & Tax">
                                        <span class="smallpolice"><br>Entrer your destination to get a shipping estimate.<br></span>
                                        <label class="etoile smallpolice"><br>Country </label>
                                        <input type="text" class="form-control">
                                        <label class="etoile smallpolice">Sate/Province </label>
                                        <input type="text" class="form-control">
                                        <label class="etoile smallpolice">Zip/Postale Code </label>
                                        <input type="text" class="form-control">
                                        <br>
                                        <button type="button" class="btn btn-outline-secondary">GET A QUOTE</button>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" type="text" value="Discount Coupon">
                                        <span class="smallpolice"><br>Entrer Coupon code below if you have one.<br></span>
                                        <label class="smallpolice"><br>Get a coupon discount here</label>
                                        <input type="text" class="form-control">
                                        <br>
                                        <button type="button" class="btn btn-outline-secondary">APPLY COUPON</button>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" type="text" value="Order Total">
                                        <span class="smallpolice"><br>Subtotal<br></span>
                                        <span class="smallpolice"><br>Grand Total<br></span>
                                        <br>
                                        <button type="button" class="btn btn-primary btn-lg btn-block">PROCEED TO CHECKOUT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-md-3">
                      <IMG src="../IMAGES/img-14.png" alt="img-14.png" />
                    </div>
                    <div class="col-md-3">
                      <IMG src="../IMAGES/img-15.png" alt="img-15.png" />
                    </div>
                    <div class="col-md-3">
                      <IMG src="../IMAGES/img-16.png" alt="img-16.png" />
                    </div>
                    <div class="col-md-3">
                      <IMG src="../IMAGES/img-17.png" alt="img-17.png" />
                    </div>
                  </div>
                  <div class="row">
                    <IMG src="../IMAGES/img-27.png" alt="img-27.png" />
                  </div>
            <div class="row">
                    <div class="col-md-6">
                      <IMG src="../IMAGES/img-19.png" alt="img-19.png" /> Facebook
                      <IMG src="../IMAGES/img-20.png" alt="img-20.png" /> Twitter
                      <IMG src="../IMAGES/img-21.png" alt="img-21.png" /> YouTube
                      <IMG src="../IMAGES/img-22.png" alt="img-22.png" /> RSS Feed
                    </div>
                      
                      <div class="col-md-3 offset-md-3 text-right">
                      <IMG src="../IMAGES/img-25.png" alt="img-25.png" />
                      <IMG src="../IMAGES/img-26.png" alt="img-26.png" />
                      <IMG src="../IMAGES/img-23.png" alt="img-23.png" />
                      <IMG src="../IMAGES/img-24.png" alt="img-24.png" />
                      </div>

                    <div class="col-md-12">
                        <hr/>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="smallpolice">©2013 SoftMarket Mangento Store by emthemes.com</span>
                            </div>
                            <div class="col-md-3 offset-md-3 text-right">
                                <span class="smallpolice"><span class="gras">EN &nbsp;</span> FR &nbsp; ES &nbsp; <span class="gras">$ </span> €  £ &</span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </body>
</html>