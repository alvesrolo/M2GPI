<?php
session_start(); 
if(isset($_POST['id'])){
   removeCart();
}

function removeCart(){
   $ret=array();


   for($i = 0 ; $i < count($_SESSION['cart']['id_product']) ; $i++)
   {
      if($_SESSION['cart']['id_product'][$i]==$_POST['id'])
      {
         array_push($ret,$_SESSION['cart']['id_product'][$i]);
         array_push($ret,$_SESSION['cart']['qte'][$i]);
         array_push($ret,$_SESSION['cart']['prix'][$i]);
         array_splice($_SESSION['cart']['id_product'],$i,1);
         array_splice($_SESSION['cart']['url_image'],$i,1);
         array_splice( $_SESSION['cart']['nom'],$i,1);
         array_splice($_SESSION['cart']['prix'],$i,1);
         array_splice($_SESSION['cart']['qte'],$i,1);
         break;
      }

   }
      //echo $_POST['id'];
      echo json_encode($ret);
}



?>