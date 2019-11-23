<?php session_start();

  class BDD{
    public $BDD;
    function connexion(){
        try
        {
            $this->BDD = new PDO('mysql:host=localhost;dbname=qar_ihm;charset=utf8', 'root', '');
            //echo("connexion OK");
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
    }
    function getSubCategories($donnees){
      try
      {
        $req = $this->BDD->prepare('SELECT * from souscategories where id_cat='.$donnees['id']);
        $req->execute();
        
        
          while ($donnees_souscat = $req->fetch())
          {
            //echo "<li><a href=page_principale.php?$donnees['id']>" . $donnees['nom'].'</a></li>';
            ?>
            <li class="sous_cat"><a class="lien js-click" href="page_principale.php?categorie=<?php echo $donnees['id'] ?>&souscategorie=<?php echo $donnees_souscat['id'] ?>"><?php echo $donnees_souscat['nom'] ?></a> (<?php $this->getCountProductsBySubCategories($donnees_souscat['id']);?>)</li>
            <?php
          }
      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }
    }
    function getCategories(){
      try
      {
        $req = $this->BDD->prepare('SELECT * from categories');
        $req->execute();
        while ($donnees = $req->fetch())
        {
          //echo "<li><a href=page_principale.php?$donnees['id']>" . $donnees['nom'].'</a></li>';
          ?>
          <li ><a class="lien box" href="page_principale.php?categorie=<?php echo $donnees['id'] ?>"><?php echo $donnees['nom']?></a> (<?php $this->getCountProducts($donnees['id']);?>)</li>
          <?php
          if (isset($_GET['categorie']) && $_GET['categorie'] == $donnees['id'] ) {
          $this->getSubCategories($donnees);
          }
          
        }
      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }
    }

    
    function getProductsByCategories(){
      try
      {
        $req = $this->BDD->prepare('SELECT * FROM categories as cat
        INNER JOIN souscategories as sc ON cat.id = sc.id_cat
        INNER JOIN produits as pr ON pr.souscategories_id = sc.id
        WHERE cat.id =?');
        $req->execute(array($_GET['categorie']));
        while ($donnees = $req->fetch())
        {
          // echo '<div class="col-md-4">' $donnees['nom'] .$donnees['prix'] . $donnees['description'] .$donnees['couleurs']. $donnees['url_image'] . $donnees['marque']'</div>';
          ?>
          <div class='col-md-4 text-center mb-4'>
            
            <IMG src="<?php echo $donnees['url_image']?>"/>
            <?php if($donnees['promotion']!=0){
              ?><IMG class="promotion" src="../IMAGES/img-09.png" alt="img-09.png" class="img-fluid"/><?php
            }
            ?>
            <?php if($donnees['nouveau']!=0){
              ?><IMG class="promotion" src="../IMAGES/img-10.png" alt="img-10.png" class="img-fluid"/><?php
            }
            ?>
            
            <div class='text-left'>
              <?php echo $donnees['nom'] ?>
            </div>
            <div class='text-left'>
              <?php echo "$".$donnees['prix'] ?>
            </div>
            <div  class="col-md-6">
            <IMG src="../IMAGES/etoile.png" alt="etoile.png" class="img-fluid"/>
            </div>
            <div>
              
              <button type="button" class="btn btn-outline-secondary mr-1" onclick='addToCart(<?php echo json_encode($donnees) ?>)'>ADD TO CART</button>
              <IMG src="../IMAGES/img-12.png" alt="img-12.png" class="img-fluid"/>
              <IMG src="../IMAGES/img-13.png" alt="img-13.png" class="img-fluid"/>
            </div>
          </div>
          <?php
        }
      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }
    }

    function getProductsBySubCategories(){
      try
      {
        $req = $this->BDD->prepare('SELECT * FROM souscategories as souscat
        INNER JOIN produits as pr ON pr.souscategories_id = souscat.id
        WHERE souscat.id=?');
        $req->execute(array($_GET['souscategorie']));
        while ($donnees = $req->fetch())
        {
          // echo '<div class="col-md-4">' $donnees['nom'] .$donnees['prix'] . $donnees['description'] .$donnees['couleurs']. $donnees['url_image'] . $donnees['marque']'</div>';
          ?>
          <div class='col-md-4 text-center mb-4'>
            
            <IMG src="<?php echo $donnees['url_image']?>"/>
            <?php if($donnees['promotion']!=0){
              ?><IMG class="promotion" src="../IMAGES/img-09.png" alt="img-09.png" class="img-fluid"/><?php
            }
            ?>
            <?php if($donnees['nouveau']!=0){
              ?><IMG class="promotion" src="../IMAGES/img-10.png" alt="img-10.png" class="img-fluid"/><?php
            }
            ?>
            
            <div class='text-left'>
              <?php echo $donnees['nom'] ?>
            </div>
            <div class='text-left'>
              <?php echo "$".$donnees['prix'] ?>
            </div>
            <div  class="col-md-6">
            <IMG src="../IMAGES/etoile.png" alt="etoile.png" class="img-fluid"/>
            </div>
            <div>
              <button type="button" class="btn btn-outline-secondary mr-1" onclick='addToCart(<?php echo json_encode($donnees) ?>)'>ADD TO CART</button>
              <IMG src="../IMAGES/img-12.png" alt="img-12.png" class="img-fluid"/>
              <IMG src="../IMAGES/img-13.png" alt="img-13.png" class="img-fluid"/>
            </div>
          </div>
          <?php
        }
      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }
    }


    function getAllProducts(){
      try
      {
        $req = $this->BDD->prepare('SELECT * from produits');
        $req->execute();
        while ($donnees = $req->fetch())
        {
          // echo '<div class="col-md-4">' $donnees['nom'] .$donnees['prix'] . $donnees['description'] .$donnees['couleurs']. $donnees['url_image'] . $donnees['marque']'</div>';
          ?>
          <div class='col-md-4 text-center mb-4'>
            
            <IMG src="<?php echo $donnees['url_image']?>"/>
            <?php if($donnees['promotion']!=0){
              ?><IMG class="promotion" src="../IMAGES/img-09.png" alt="img-09.png" class="img-fluid"/><?php
            }
            ?>
            <?php if($donnees['nouveau']!=0){
              ?><IMG class="promotion" src="../IMAGES/img-10.png" alt="img-10.png" class="img-fluid"/><?php
            }
            ?>
            
            <div class='text-left'>
              <?php echo $donnees['nom'] ?>
            </div>
            <div class='text-left'>
              <?php echo "$".$donnees['prix'] ?>
            </div>
            <div  class="col-md-6">
            <IMG src="../IMAGES/etoile.png" alt="etoile.png" class="img-fluid"/>
            </div>
            <div>
              <button type="button" class="btn btn-outline-secondary mr-1" onclick='addToCart(<?php echo json_encode($donnees) ?>)'>ADD TO CART</button>
              <IMG src="../IMAGES/img-12.png" alt="img-12.png" class="img-fluid"/>
              <IMG src="../IMAGES/img-13.png" alt="img-13.png" class="img-fluid"/>
            </div>
          </div>
          <?php
        }
      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }
    }


    function getCountAllProducts(){
      try
      {
        if(isset($_GET['categorie']) && !isset($_GET['souscategorie'])){
          $req = $this->BDD->prepare('SELECT count(*) FROM categories as cat
          INNER JOIN souscategories as sc ON cat.id = sc.id_cat
          INNER JOIN produits as pr ON pr.souscategories_id = sc.id
          WHERE cat.id =?');
          $req->execute(array($_GET['categorie']));
        }elseif (isset($_GET['souscategorie'])){
          $req = $this->BDD->prepare('SELECT count(*) FROM souscategories as souscat
          INNER JOIN produits as pr ON pr.souscategories_id = souscat.id
          WHERE souscat.id =?');
          $req->execute(array($_GET['souscategorie']));
        }
        else {
          $req = $this->BDD->prepare('SELECT count(*) from produits');
          $req->execute();
        }
        $donnees = $req->fetchColumn();
        echo $donnees;

      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }
    }

    function getCountProducts($categories_id){
      try
      {
          $req = $this->BDD->prepare('SELECT count(*) FROM categories as cat
          INNER JOIN souscategories as sc ON cat.id = sc.id_cat
          INNER JOIN produits as pr ON pr.souscategories_id = sc.id
          WHERE cat.id =?');
          $req->execute(array($categories_id));
       
        /*else {
          $req = $this->BDD->prepare('SELECT count(*) from produits');
          $req->execute();
        }*/
        $donnees = $req->fetchColumn();
        echo $donnees;

      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }
    }

    function getCountProductsBySubCategories($subcategories_id){
      try
      {
          $req = $this->BDD->prepare('SELECT count(*) FROM souscategories as souscat
          INNER JOIN produits as pr ON pr.souscategories_id = souscat.id
          WHERE souscat.id =?');
          $req->execute(array($subcategories_id));
          $donnees = $req->fetchColumn();
          echo $donnees;

      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }
    }

    function getBrand(){
      try
      {
        $req = $this->BDD->prepare('SELECT * from marque');
        $req->execute();
        while ($donnees = $req->fetch())
        {
          ?>
          <div class="form-check">
          <input type="checkbox" class="form-check-input" />
          <label class="form-check-label" for="exampleCheck1"
            ><?php echo $donnees['nom'];?></label>
        </div>
         <?php
          
        }
      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }
    }

    function getCountCart(){

      if (!empty($_SESSION['cart'])){
        echo count($_SESSION['cart']['id_product']);
      }else{
         echo 0;
      }
    }

  }
      

      /*function addCart($donnees)
      {
        if (empty($_SESSION['cart']))
        {

        }
        else{
          array_push($_SESSION['cart']['id_article'],$donnees['id']);
          array_push($_SESSION['cart']['qte'],1);
          array_push($_SESSION['cart']['url_image'],$donnees['url_image']);
          array_push($_SESSION['cart']['prix'],$donnees['prix']);
        }
                
      }
   
      function countCart()
      {
        if (!empty($_SESSION['cart']))
        {
          foreach($_SESSION['cart']['id_article'])
          {
            $nbCart = $nbCart + 1;
          }          
          return $nbCart;
        }
        return 0;
      }
    */

  $bdd_co = new BDD();

  $bdd_co->connexion();

 

?>

<HTML>
  <HEAD>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
     
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
    <link type="text/css" rel="stylesheet" href="../CSS/softmarket.css" />
   
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
    <TITLE> SoftMarket Alves Rolo Quentin M2GPI 2019</TITLE>
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
              <button type="button" class="btn btn-online-primary dropdown-toggle" data-toggle="dropdown"><span class="blue-text" onclick="location.href='panier.php'">My Cart (<span id="counter-cart"><?php $bdd_co->getCountCart(); ?></span>) &nbsp;</span></button>
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
      <span class="path">Home  >  Design</span>
      <h3>Design</h3><BR>
      <div class="row mb-4">
        <div class="col-md-3 ">
          <div class="border gray-background">
            <div class="ml-3 mt-3 mb-3">
              <b>Shop By</b>
            </div>
          </div>
          <div class="border">
            <div class="ml-3 mt-2 mr-3">
              <p class="gray-text">Categories</p>
              <hr />
              <?php
               $bdd_co->getCategories();
               ?>
              <p class="gray-text mt-4">Prices</p>
              <hr />
              <img class="img-fluid" src="../IMAGES/range.png" alt="" />

              <p class="gray-text mt-4">Color</p>
              <hr />
              <img class="img-fluid" src="../IMAGES/colors.png" alt="" />

              <p class="gray-text mt-4">Brand</p>
              <hr />

              <div class="mb-4">
                
                <?php $bdd_co->getBrand();?>
              </div>
            </div>
          </div>
        </div>

        <div class="offset-md-1 col-md-8">
          <IMG src="../IMAGES/img-03.png" alt="img-03.png" class="img-fluid"/>
        <div class="row mt-4">
          <div class="col-2">
            <?php $bdd_co->getCountAllProducts();?> item(s)
          </div>
          <div class="text-right col-10 ">
            <IMG src="../IMAGES/img-04.png" alt="img-04.png" class="img-fluid"/>
            <IMG src="../IMAGES/img-05.png" alt="img-05.png" class="img-fluid"/>
            <IMG src="../IMAGES/img-06.png" alt="img-06.png" class="img-fluid"/>
            <IMG src="../IMAGES/img-07.png" alt="img-07.png" class="img-fluid"/>
          </div>
        </div>
          <hr>
        <div class="row">
          <?php 
             if (isset($_GET['categorie']) && !isset($_GET['souscategorie'])) {
                $bdd_co->getProductsByCategories($_GET['categorie']);
              } elseif(isset($_GET['souscategorie'])){
                $bdd_co->getProductsBySubCategories($_GET['souscategorie']);
              }
              else {
                $bdd_co->getAllProducts();
          }
          ?>
        </div>
        </div>
      </div>

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
          <hr />
          <div class="row">
            <div class="col-md-6">
              <span class="smallpolice"
                >©2013 SoftMarket Mangento Store by emthemes.com</span
              >
            </div>
            <div class="col-md-3 offset-md-3 text-right">
              <span class="smallpolice"
                ><span class="gras">EN &nbsp;</span> FR &nbsp; ES &nbsp;
                <span class="gras">$ </span> € £ &</span
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</HTML>
<script src="../JS/function.js" type="text/javascript"> </script>
