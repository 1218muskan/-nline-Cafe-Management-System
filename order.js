var orderFoodCard = document.querySelectorAll(".order-food-card");
var viewCartBtn = document.querySelector(".confirm-order-cont > a");
// var myCartCont = document.querySelector(".view-cart-cont");

let cartItemObjArr = [];
// cartItemObj --> id , name, price, quantity


orderFoodCard.forEach(orderFoodCardItem => {

    var addToCart = orderFoodCardItem.querySelector(".add-to-cart");
    var itemID = orderFoodCardItem.id;
    var itemName = orderFoodCardItem.querySelector("h3").textContent;
    var itemPrice = orderFoodCardItem.querySelector(".price").textContent;

    addToCart.addEventListener("click", function(){
        alert("Item added to cart");

        var cartItemObj = {
            id: itemID,
            name: itemName,
            price: itemPrice,
            quantity: 1
        };

        cartItemObjArr.push(cartItemObj);
    });

    
});


function viewCart(){

    if(cartItemObjArr.length === 0){

        alert("0 items added to cart");
        viewCartBtn.href = "order.html";
    }
}


