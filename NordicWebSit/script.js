function toggleCart() {
    document.getElementById("cartSidebar").classList.toggle("active");
}

function toggleOrders() {
    document.getElementById("ordersSidebar").classList.toggle("active");
}

function checkout() {
    window.location.href = "checkout.php";
}