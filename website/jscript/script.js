let cart = [];

function addToCart(productName, price) {
    cart.push({ productName, price });
    updateCartUI();
}

function updateCartUI() {
    let cartElement = document.getElementById('cart');
    if (cart.length > 0) {
        let cartHTML = '<ul>';
        cart.forEach((item) => {
            cartHTML += `<li>${item.productName} - $${item.price}</li>`;
        });
        cartHTML += '</ul>';
        cartElement.innerHTML = cartHTML;
    } else {
        cartElement.innerHTML = '<p>No items in cart.</p>';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    //alert('Welcome to Our Shopping Site!');
    setInterval(updateRemainingTime, 1000); // Update remaining time every second
});

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}

const slideshowContainer = document.querySelector('.slideshow-container');

slideshowContainer.addEventListener('mouseover', () => {
    document.querySelector('.slide-track').style.animationPlayState = 'paused';
});

slideshowContainer.addEventListener('mouseout', () => {
    document.querySelector('.slide-track').style.animationPlayState = 'running';
});
