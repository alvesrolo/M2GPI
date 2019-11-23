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
    
  }


  function addCart()
      {
        
        if (empty($_SESSION['cart']))
        {
            createCart();
            pushIntoCart();
            $counter = count($_SESSION['cart']['id_product']);
            echo json_encode($counter);
            
        }
        else {
            pushIntoCart();
            $counter = count($_SESSION['cart']['id_product']);
            echo json_encode($counter);
        }
                
      }


     function pushIntoCart(){
        array_push($_SESSION['cart']['id_product'],$_POST['id']);
        array_push($_SESSION['cart']['qte'],1);
        array_push($_SESSION['cart']['url_image'],$_POST['url_image']);
        array_push($_SESSION['cart']['prix'],$_POST['prix']);
      }
?>