<?php


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATH_TEMPLATES . 'base/html_head.php'?>
    <link rel="stylesheet" href="<?=URL_CSS?>login/login.css">
    <script type="text/javascript" src="<?=URL_JS?>login/login.js"></script>
</head>
<body>
    <main id="main-login">
        <img src="<?=URL_IMGS . 'sanidapp-favicon.svg';?>">
        <form id="form_login" action="<?=PATH_LOGIN?>">
            <div class="form-input">
                <label for="username">NOMBRE DE USUARIO</label>
                <input type="text" id="username">
            </div>
            <div class="form-input">
                <label for="password">CONTRASEÑA</label>
                <input type="password" id="password">
            </div>
            
        </form>
    <button id="btn_login">INICIAR SESIÓN</button>
    <img id="spinner" src="<?=URL_IMGS?>spinner.svg" style="display:none;">
    <div id="error-log" style="display:none"><p></p></div>
    </main>
</body>
</html>