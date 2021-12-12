var myCartCont = document.querySelector(".view-cart-cont");
        console.log(myCartCont);

        console.log(cartItemObjArr)
        cartItemObjArr.forEach(cartItemObj => {

            console.log(cartItemObj);
            var divElement = `<div class="cart-food-item">

            <div class="cart-food-item-name">${cartItemObj.name}</div>
            <div class="price-per-plate">${cartItemObj.price}</div>
            <div class="cart-item-count"><input type="number" value="${cartItemObj.quantity}" min="1"></input></div>
            <div class="cart-item-remove-btn-cont"><button class="remove-cart-item">Remove</button></div>
            <div class="cart-item-price">${cartItemObj.price * cartItemObj.quantity}</div>
        </div>`;

        myCartCont.appendChild(divElement);
        // myCartCont.insertAdjacentHTML("afterend", divElement);
        // myCartCont.innerHTML += divElement;
            
        });