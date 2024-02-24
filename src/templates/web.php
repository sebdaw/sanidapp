<?php

    $urlimg1 = URL_IMGS . 'img1.jpg';
    $urlimg2 = URL_IMGS . 'img2.jpg';
    $urlimg3 = URL_IMGS . 'img3.jpg';
    $urlimg4 = URL_IMGS . 'img4.jpg';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATH_TEMPLATES . 'base/html_head.php'?>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="<?=URL_CSS?>web/style.css">
    <script src="<?=URL_JS?>web/app.js"></script>
</head>
<body>
    <header>    
        <img id="header-logo" src="<?=URL_IMGS?>logo.png">
        <div><a href="login">INICIAR SESIÓN</a></div>
   </header> 
   <main>
        <section id="gallery"class="splide animate__animated animate__fadeIn animate__delay-2s" aria-labelledby="carousel-heading">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide" data-splide-interval="4000"><div class="divcar animate__animated animate__fadeIn"><div class="txt-overlay"><p></p></div><img class="imgcar" src="<?=$urlimg1?>"></div></li>
                    <li class="splide__slide" data-splide-interval="4000"><div class="divcar animate__animated animate__fadeIn"><div class="txt-overlay"><p></p></div><img class="imgcar" src="<?=$urlimg2?>"></div></li>
                    <li class="splide__slide" data-splide-interval="4000"><div class="divcar animate__animated animate__fadeIn"><div class="txt-overlay"><p></p></div><img class="imgcar" src="<?=$urlimg3?>"></div></li>
                    <li class="splide__slide" data-splide-interval="4000"><div class="divcar animate__animated animate__fadeIn"><div class="txt-overlay"><p></p></div><img class="imgcar" src="<?=$urlimg4?>"></div></li>
                </ul>
            </div>
        </section>
        <article id="introduccion">
            <h1 class="animate__animated animate__fadeInDown">¿QUÉ ES SANIDAPP?</h1>
            <p> <b style="color:orange">Sanidapp</b> una plataforma web que centraliza y unifica los procesos administrativos elementales de diferentes hospitales y centros sanitarios. Su propósito es mejorar la gestión de la información médica y atención sanitaria. En una sociedad cada vez más digitalizada, esta aplicación puede ofrecer beneficios significativos para los pacientes y personal sanitario, al permitir una gestión más eficiente de los procesos administrativos y clínicos.</p>
        </article>
        <article id="centers-article">
            <div id="servicios"class="animate__animated animate__fadeIn animate__fadeInLeftBig">
                <h2>SERVICIOS</h2>
                <div class="servicio animate__animated animate__fadeIn animate__delay-1s">
                    <img src="<?=URL_IMGS?>doctor.svg">
                    <p>Gestión de consultas</p>
                </div>
                <div class="servicio animate__animated animate__fadeIn animate__delay-1s">
                    <img src="<?=URL_IMGS?>calendar.svg">
                    <p>Calendario de citas</p>
                </div>
                <div class="servicio animate__animated animate__fadeIn animate__delay-1s">
                    <img src="<?=URL_IMGS?>history.svg">
                    <p>Consulta de historial clínico</p>
                </div>
                <div class="servicio animate__animated animate__fadeIn animate__delay-1s">
                    <img src="<?=URL_IMGS?>chat.svg">
                    <p>Mensajería con profesionales sanitarios</p>
                </div>
                <div class="servicio animate__animated animate__fadeIn animate__delay-1s">
                    <img src="<?=URL_IMGS?>multiprofile.svg">
                    <p>Multiperfil para familias</p>
                </div>
            </div>
            <div id="mapa"class="animate__animated animate__fadeInRightBig">
                <h2>NUESTRA SEDE</h2>
                <iframe class="animate__animated animate__fadeIn animate__delay-1s"src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d24102.590462380747!2d-5.669212099999999!3d40.9634385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1708538615045!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </article>
   </main>
   <footer>

   </footer>
</body>
</html>