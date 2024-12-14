document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('usernameInput');
    const prefix = document.querySelector('.prefix');

    input.addEventListener('focus', function () {
        prefix.style.color = '#000';
    });

    input.addEventListener('blur', function () {
        prefix.style.color = '#666';
    });

    const originalStoresSlide = document.querySelector(".stores-slide")
    const copy = originalStoresSlide.cloneNode(true)

    document.querySelector(".store-slider").appendChild(copy)
});


redirectToRegister = () => {
    const input = document.getElementById('usernameInput');
    const username = input.value;

    localStorage.setItem('username', username);

    window.location.href = '/register';
}
