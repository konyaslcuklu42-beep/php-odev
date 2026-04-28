let cart = [];
let total = 0;

function addToCart(name, price , image) {
    cart.push({ name, price, image });
    total += price;

    document.getElementById("cart-count").innerText = cart.length;
    updateCart();
}

function updateCart() {
    const cartItems = document.getElementById("cart-items");
    cartItems.innerHTML = "";

    cart.forEach((item, index) => {
        cartItems.innerHTML += `
            <div class="cart-item">
            <img src="${item.image}>"
            width="50">
                <span>${item.name} - ₺${item.price}</span>
                <button onclick="removeItem(${index})">X</button>
            </div>
        `;
    });

    document.getElementById("total-price").innerText = total;
}

function removeItem(index) {
    total -= cart[index].price;
    cart.splice(index, 1);

    document.getElementById("cart-count").innerText = cart.length;
    updateCart();
}

function toggleCart() {
    document.getElementById("cart-panel").classList.toggle("active");
}