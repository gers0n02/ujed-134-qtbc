<footer class="footer">
    <div class="contenedor">
        <div class="barra">
            <a href="<?php echo BASE_URL; ?>index.php" class="logo">
                <img src="<?php echo BASE_URL; ?>assets/img/logo.png" class="logo__nombre" alt="Logo FCQ">
            </a>

            <nav class="navegacion">
                <a href="https://www.facebook.com/profile.php?id=61574926917536" class="navegacion__enlace" target="_blank">Facebook</a>
                <a href="https://www.tiktok.com/@qtbc_?is_from_webapp=1&sender_device=pc" class="navegacion__enlace" target="_blank">TikTok</a>
                <a href="https://www.instagram.com/qtbc_134?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="navegacion__enlace" target="_blank">Instagram</a>
            </nav>   
        </div>
    </div>

    <div class="footer__contenedor">
        <div class="footer-box">
            <h4>Ubicación</h4>
            <p>
                Artículo 123 s/n, Col. Filadelfia<br>
                Gómez Palacio, Dgo. C.P. 35019
            </p>
        </div>
        <div class="footer-box">
            <h4>Contacto</h4>
            <p>
                📞 (871) 715 8810 y (871) 715 2964<br>
                ✉️ fcqgp@ujed.mx
            </p>
        </div>
    </div>


    <p class="texto-blanco center-text">&copy; <?php echo date('Y'); ?>  QTBC-134 FCQGP, UJED</p>
</footer>

<script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>

<script>
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
</script>
</body>
</html>