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

  
  function removeToCart(product){

    //console.log(product);
    object = {
      id : product
    }
    $.ajax({
      url: "remove_to_cart.php",
      type: "POST",
      data: object,
      success: function(data){
          alert("success : le produit a été supprimé avec succès");
          //console.log(data);
          const tempo=JSON.parse(data);
          $('#line_'+parseInt(tempo[0])).remove();
          var spansCart = $('#counter-cart');
          //console.log(spansCart.text());
          let spansValue=parseInt(spansCart.text())-tempo[1];
          spansCart.text(spansValue);

          var spansSmallSubtotal = $('#counter-SmallSubtotal');
          let spansSmallSubValue=parseInt(spansSmallSubtotal.text())-(tempo[1]*tempo[2]);
          spansSmallSubtotal.text(spansSmallSubValue);

          var spansSubtotal = $('#counter-Subtotal');
          let spansSubValue=parseInt(spansSubtotal.text())-(tempo[1]*tempo[2]);
          spansSubtotal.text(spansSubValue);
      }
  })
  .fail(function(data) {
      alert("failure" + data[0]);
  });
    
    }