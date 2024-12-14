const username = document.getElementById('username');

if (localStorage.getItem('username')) {
    username.value = localStorage.getItem('username');
}
