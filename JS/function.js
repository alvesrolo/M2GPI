function addToCart(product){
  $.ajax({
    url: "add_to_cart.php",
    type: "POST",
    data: product,
    success: function(data){
        alert("success : le produit a été ajouté avec succès");
        var spansCart = $('#counter-cart');
        spansCart.text(data);
    }
})
.fail(function(data) {
    alert("failure" + data[0]);
});
  
  }