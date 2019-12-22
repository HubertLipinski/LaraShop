window.addEventListener('scroll', function(e) {
    let pos = window.scrollY;
    let offset = pos * 3.5;
    const text = document.getElementById('text');
    const cart = document.getElementById('cart');

    let fade;
    (pos <= 0)
        ? fade = 1
        : fade = parseFloat((20/offset).toFixed(1));

    text.style.transform = 'translate3d(-'+offset+'px,'+offset/4+'px,0px)';
    cart.style.transform = 'translate3d('+offset+'px,'+offset/4+'px,0px)';
    cart.style.opacity = fade;
});
