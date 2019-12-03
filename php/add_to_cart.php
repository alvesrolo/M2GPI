<?php
session_start(); 
if(isset($_POST['id'])){
   addCart();
}


function createCart(){

      $_SESSION['cart']=array();
      /* Subdivision du panier */
      $_SESSION['cart']['id_product'] = array();
      $_SESSION['cart']['qte'] = array();
      $_SESSION['cart']['url_image'] = array();
      $_SESSION['cart']['prix'] = array();
      $_SESSION['cart']['nom'] = array();
    
  }

  function getCountCart(){
      
    if (!empty($_SESSION['cart'])){
      $count=0;
      for($i = 0 ; $i < count($_SESSION['cart']['id_product']) ; $i++)
      {
        $count= $_SESSION['cart']['qte'][$i] + $count;
      }
      return $count;
    }else{
      return 0;
    }
  }


  function addCart()
      {
        
        if (empty($_SESSION['cart']))
        {
            createCart();
            pushIntoCart();
           // $counter = count($_SESSION['cart']['id_product']);
            echo json_encode(getCountCart());
            
        }
        else {
            pushIntoCart();
            //$counter = count($_SESSION['cart']['id_product']);
            echo json_encode(getCountCart());
        }
                
      }


      function pushIntoCart(){
        
        for($i = 0 ; $i < count($_SESSION['cart']['id_product']) ; $i++)
        {
          if ($_POST['id'] == $_SESSION['cart']['id_product'][$i] )
              {
                $_SESSION['cart']['qte'][$i] = $_SESSION['cart']['qte'][$i] + 1;
                return;              
              }
        }
        array_push($_SESSION['cart']['id_product'],$_POST['id']);
        array_push($_SESSION['cart']['qte'],1);
        array_push($_SESSION['cart']['url_image'],$_POST['url_image']);
        array_push($_SESSION['cart']['prix'],$_POST['prix']);
        array_push($_SESSION['cart']['nom'],$_POST['nom']);
      }
?>