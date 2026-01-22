let indice = 0;
const secciones = document.querySelectorAll('.mision-vision .contenido');
const contenedor = document.querySelector('.mision-vision');

function cambiar() {
    secciones[indice].classList.remove('activo');
    indice = (indice + 1) % secciones.length;
    secciones[indice].classList.add('activo');

    const nuevaAltura = secciones[indice].offsetHeight;
    contenedor.style.height = nuevaAltura + 'px';
}

contenedor.style.height = secciones[0].offsetHeight + 'px';

setInterval(cambiar, 5000);

function togglePassword(id) {
    const input = document.getElementById(id);
    const icon = input.nextElementSibling;

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "ocultar";
    } else {
        input.type = "password";
        icon.textContent = "ver";
    }
}

let lastScroll = 0;
const header = document.querySelector('.header');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll <= 0) {
        header.classList.remove('hide');
        return;
    }

    if (currentScroll > lastScroll && currentScroll > 120) {
        // bajando
        header.classList.add('hide');
    } else {
        // subiendo
        header.classList.remove('hide');
    }

    lastScroll = currentScroll;
});
