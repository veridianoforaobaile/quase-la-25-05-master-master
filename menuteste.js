const menuBotao = document.querySelector('#menu-botao');
const menu = document.querySelector('#menu');
const menuImage = document.querySelector('.menu-image');

menu.style.display = 'none';

menuBotao.addEventListener('click', () => {
    if (menu.style.display === 'none') {
        menu.style.display = 'flex';
        menuImage.style.visibility = 'hidden';
    } else {
        menu.style.display = 'none';
        menuImage.style.visibility = 'visible';
    }
});
